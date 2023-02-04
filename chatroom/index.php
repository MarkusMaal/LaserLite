<?php
	/*
	Error code reference
	
	0   - No chat name provided
	1   - No chat ID provided
	2   - No username or password provided
	3   - Specified chat does not exist
	4   - SQL query failed
	5   - This username is unavailable
	6-7 - Wrong username or password
	8   - Unspecified error
	9   - No message content provided
	10  - Not a member of specified chat
	11  - Insufficient privileges
	12  - Chat not found
	13  - Insufficient privileges
	14  - This chat name is unavailable
	15  - You can't change your own privileges
	16  - Chat owner's privileges cannot be changed
	17  - No chat ID, target username, or privileges provided
	18  - Privileges were not provided in the correct format. The correct format is ---, where each place is either 1 or 0
	19  - Current version not specified
	20  - Attachment details missing
	21  - Unable to upload attachment
	22  - You do not have permission to upload this attachment.
	23  - Input line specified exceeds server quota
	24  - The attachment file size exceeds server quota
	25  - The number of attachments has exceeded server quota. Clear all of your attachments to send a new one.
	26  - The cumulative file size for all sent attachments has exceeded server quota. Clear all of your attachments to send a new one.
	27  - The total allocated space for attachments has exceeded server quota. Ask server owner to allocate more space or delete your attachments.
	28  - The total number of attachments for all chatroom users has exceeded server quota. Ask server owner to allow more attachments or delete your attachments.
	29  - Attachment not specified
	30  - Attachment not found or not linked to user specified
	*/

	$latest_version = 4.0;
	// Maximum server allocation for a single line in a file is 1024B
	$line_quota = 1024;
	// Maximum server allocation for a single file is 128KiB
	$size_quota = 131072;
	// Maximum server allocation for a single user, when it comes to the number of files is 100
	$user_quota = 100;
	// Maximum server allocation for a single user is set to 12.5MiB
	$user_size_quota = $size_quota * $user_quota;
	// Maximum server allocation for all attachment data is set to 6.11GiB
	$server_quota = 6560562544;
	// Maximum server allocation for the number of all attachments
	$server_count_quota = 50000;
	
	function RETURN_FAILURE() {
		die("set /a success=0\r\n");
	}
	
	function RETURN_ECODE($code) {
		echo "set /a ecode=" . $code . "\r\n";
	}
	
	function RETURN_ERROR($code) {
		RETURN_ECODE($code);
		RETURN_FAILURE();
	}

	function PASSWD_CHECK() {
		if (empty($_GET["username"]) || empty($_GET["password"]))
		{
			RETURN_ECODE(2);
			RETURN_FAILURE();
		} 
	}
	
	function CHAT_DATA_CHECK() {
		if (empty($_GET["chat_name"]))
		{
			RETURN_ECODE(0);
			RETURN_FAILURE();
		} 
	}
	
	function EXTENDED_CHAT_DATA_CHECK($chatrooms) {
		CHAT_DATA_CHECK();
		if (empty($_GET["chat_id"]))
		{
			RETURN_ECODE(1);
			RETURN_FAILURE();
		} else {
			$CHAT_ID = 0;
			foreach ($chatrooms as &$chatroom) {
				if ($chatroom["ID"] == $_GET["chat_id"]) {
					$CHAT_ID = $_GET["chat_id"];
					if ($chatroom["ENCRYPTED"] == 1) {
						if (empty($_GET["chat_passwd"])) {
							RETURN_FAILURE();
						} else {
							if (MD5($_GET["chat_name"] . "*TCR*" . $_GET["chat_passwd"]) == $chatroom["PASSWORD"]) {
								return $CHAT_ID;
							} else {
								RETURN_FAILURE();
							}
						}
					}
				}
			}
			if ($CHAT_ID == 0) {
				RETURN_ECODE(3);
				RETURN_FAILURE();
			}
		}
	}
	
	function GET_NEW_CHAT_ID($connection) {
		$CHAT_ID = 0;
		$query = "SELECT * FROM chatrooms ORDER BY(ID) DESC LIMIT 1";
		$result = mysqli_query($connection, $query);
		$row = mysqli_fetch_array($result);
		return $row["ID"];
	}
	
	function GET_USER($users) {
		$hash = md5($_GET["username"] . "*TCR*" . $_GET["password"]);
		foreach ($users as &$user) {
			if ($user["PASSWORD"] == $hash) {
				return $user["ID"];
			}
		}
		return 0;
	}
	
	function LOGON_CHECK($users) {
		$hash = md5($_GET["username"] . "*TCR*" . $_GET["password"]);
		$ID = GET_USER($users);
		if ($ID == 0) {
			RETURN_ECODE(6);
			RETURN_FAILURE();
		}
		return $ID;
	}
	
	function SQL_EXECUTE($connection, $sql) {
		if ($connection->query($sql) === TRUE) {
			echo "set /a success=1\r\n";
		} else {
			RETURN_ECODE(4);
			RETURN_FAILURE();
		}
	}
	
	// Delete attachments that are older than 30 days
	function MAINTENANCE($connection, $attachments) {
		foreach ($attachments as &$attachment) {
			$path = $_SERVER["DOCUMENT_ROOT"] . "/chatroom/attachments/" . $attachment["FILENAME"];
			$creation = filectime($path);
			$now = new DateTime();
			if ($creation + 30 * 24 * 60 * 60 < time()) {
				SQL_EXECUTE($connection, "DELETE FROM attachments WHERE ID = " . $attachment["ID"]);
				if (!unlink($path)) {
					error_log("Chatroom Server: Attachment \"" . $attachment["FILENAME"] . "\" couldn't be deleted!");
				}
				$connection->close();
			}
		}
	}
	
	function FRIENDLY_SIZE($bytes) {
		if ($bytes < 1024) {
			return "{$bytes}B";
		}
		else if ($bytes > 1024) {
			$out = $bytes / 1024;
			return "{$out}kiB";
		}
	}

	include("initialize.php");
	MAINTENANCE($connection, $attachments);
	if (empty($_GET)) {
		echo '<html><head><style>body { padding: 5em; background: black; font-family: sans-serif; color: lightgray; }</style><title>The Chatroom API default page</title></head><body><h1>The Chatroom</h1><p>This is the default page for the chatroom API. If you are seeing this, it means that the API is installed and working properly. It is now ready to be deployed into a batch application.</p></body></html>';
	} else {
		if (!empty($_GET["test"])) {
			echo "set /a success=1\r\n";
		}
		else if (!empty($_GET["register"])) {
			PASSWD_CHECK();
			foreach ($users as &$user) {
				if ($_GET["username"] == $user["USERNAME"]) {
					RETURN_ECODE(5);
					RETURN_FAILURE();
				}
			}
			SQL_EXECUTE($connection, "INSERT INTO members (USERNAME, PASSWORD) VALUES (\"" . $_GET["username"] . "\", MD5(\"" . $_GET["username"] . "*TCR*" . $_GET["password"] . "\"))");
			$connection->close();
		}
		else if (!empty($_GET["login"])) {
			PASSWD_CHECK();
			LOGON_CHECK($users);
			echo "set /a success=1\r\n";
		}
		else if (!empty($_GET["update_uname"])) {
			PASSWD_CHECK();
			$ID = GET_USER($users);
			if ($ID == 0) {
				RETURN_ECODE(7);
				RETURN_FAILURE();
			}
			if (empty($_GET["newuser"])) {
				RETURN_ECODE(16);
				RETURN_FAILURE();
			}
			SQL_EXECUTE($connection, "UPDATE members SET USERNAME = \"" . $_GET["newuser"] . "\" WHERE ID = " . $ID);
			SQL_EXECUTE($connection, "UPDATE members SET PASSWORD = MD5(\"" . $_GET["newuser"] . "*TCR*" . $_GET["password"] . "\") WHERE ID = " . $ID);
			echo "set /a success=1\r\n";
		}
		else if (!empty($_GET["update_passwd"])) {
			PASSWD_CHECK();
			$ID = GET_USER($users);
			if ($ID == 0) {
				RETURN_ECODE(7);
				RETURN_FAILURE();
			}
			if (empty($_GET["newpass"])) {
				RETURN_ECODE(15);
				RETURN_FAILURE();
			}
			SQL_EXECUTE($connection, "UPDATE members SET PASSWORD = MD5(\"" . $_GET["username"] . "*TCR*" . $_GET["newpass"] . "\") WHERE ID = " . $ID);
			echo "set /a success=1\r\n";
		}
		else if (!empty($_GET["get_my_chats"])) {
			PASSWD_CHECK();
			$ID = GET_USER($users);
			if ($ID == 0) {
				RETURN_ECODE(7);
				RETURN_FAILURE();
			} else {
				echo "set /a success=1\r\n";
				$i = 1;
				foreach ($chatrooms as &$chatroom) {
					if ($chatroom["OWNER_ID"] == $ID) {
						echo "set \"mychat" . $i . "_name=" . $chatroom["NAME"] . "\"\r\n";
						echo "set /a mychat" . $i . "_id=" . $chatroom["ID"] . "\r\n";
						$i++;
					}
				}
			}
		}
		else if (!empty($_GET["make_chat"])) {
			PASSWD_CHECK();
			CHAT_DATA_CHECK();
			$ID = GET_USER($users);
			if ($ID == 0) {
				RETURN_ECODE(7);
				RETURN_FAILURE();
			} else {
				// check if chat already exists for this use
				foreach ($chatrooms as &$chatroom) {
					if ($chatroom["NAME"] == $_GET["chat_name"]) {
						RETURN_ECODE(14);
						RETURN_FAILURE();
					}
				}
				if (empty($_GET["chat_passwd"])) {
					// unencrypted chat
					SQL_EXECUTE($connection, "INSERT INTO chatrooms (NAME, OWNER_ID) VALUES (\"" . $_GET["chat_name"] . "\", " . $ID . ");");
				} else {
					// encrypted chat
					SQL_EXECUTE($connection, "INSERT INTO chatrooms (NAME, OWNER_ID, ENCRYPTED, PASSWORD) VALUES (\"" . $_GET["chat_name"] . "\", " . $ID . ", 1, \"" . MD5($_GET["chat_name"] . "*TCR*" . $_GET["chat_passwd"]) . "\");");
				}
				$CHAT_ID = GET_NEW_CHAT_ID($connection);
				SQL_EXECUTE($connection, "INSERT INTO chatters (MEMBER_ID, CHAT_ID, PRIVILEGES) VALUES (" . $ID . ", " . $CHAT_ID . ", 111);");
			}
		}
		else if (!empty($_GET["show_chat"])) {
			PASSWD_CHECK();
			EXTENDED_CHAT_DATA_CHECK($chatrooms);
			LOGON_CHECK($users);
			$chat_id = $_GET["chat_id"];
			foreach ($messages as &$message) {
				if ($message["CHAT_ID"] == $chat_id) {
					foreach ($chatters as &$chatter) {
						if (($chatter["CHAT_ID"] == $chat_id) && ($message["CHATTER_ID"] == $chatter["ID"])) {
							foreach ($users as &$user) {
								if ($user["ID"] == $chatter["MEMBER_ID"]) {
									echo $user["USERNAME"] . "> ";
								}
							}
						}
					}
					echo $message["MESSAGE"] . "\r\n";
				}
			}
		}
		else if (!empty($_GET["send_message"])) {
			/*
			Privileges
			1-- - Can message
			-1- - Can clear screen
			--1 - Can delete chat
			0 signifies that this action cannot be performed
			*/
			PASSWD_CHECK();
			EXTENDED_CHAT_DATA_CHECK($chatrooms);
			LOGON_CHECK($users);
			$chat_id = $_GET["chat_id"];
			$privileges = "000";
			$chatter_id = 0;
			if (empty($_GET["message"])) {
				RETURN_ECODE(9);
				RETURN_FAILURE();
			}
			$user_id = -1;
			foreach ($users as &$user) {
				if ($user["USERNAME"] == $_GET["username"]) {
					$user_id = $user["ID"];
				}
			}
			foreach ($chatters as &$chatter) {
				if (($chatter["CHAT_ID"] == $chat_id)) {
					$privileges = $chatter["PRIVILEGES"];
					foreach ($users as &$user) {
						if ($user_id == $chatter["MEMBER_ID"]) {
							$chatter_id = $chatter["ID"];
						}
					}
				}
			}
			if ($chatter_id == 0) {
				RETURN_ECODE(10);
				RETURN_FAILURE();
			}
			if (($privileges == "100") || ($privileges == "110") || ($privileges == "101") || ($privileges == "111")) {
				SQL_EXECUTE($connection, "INSERT INTO messages (CHATTER_ID, CHAT_ID, MESSAGE) VALUES (" . $chatter_id . ", " . $chat_id . ", \"" . $_GET["message"] . "\");");
			} else {
				RETURN_ECODE(13);
				RETURN_FAILURE();
			}
		}
		else if (!empty($_GET["clear"])) {
			PASSWD_CHECK();
			EXTENDED_CHAT_DATA_CHECK($chatrooms);
			LOGON_CHECK($users);
			$chat_id = $_GET["chat_id"];
			$privileges = "000";
			$chatter_id = 0;
			$uid = -1;
			foreach ($users as &$user) {
				if ($user["USERNAME"] == $_GET["username"]) {
					$uid = $user["ID"];
				}
			}
			foreach ($chatters as &$chatter) {
				if (($chatter["CHAT_ID"] == $chat_id) && ($chatter["MEMBER_ID"] == $uid)) {
					$privileges = $chatter["PRIVILEGES"];
					foreach ($users as &$user) {
						if ($user["ID"] == $chatter["MEMBER_ID"]) {
							$chatter_id = $chatter["ID"];
						}
					}
				}
			}
			if ($chatter_id == 0) {
				RETURN_ECODE(12);
				RETURN_FAILURE();
			}
			if (($privileges == "110") || ($privileges == "111") || ($privileges == "010") || ($privileges == "011")) {
				SQL_EXECUTE($connection, "DELETE FROM messages WHERE CHAT_ID = " . $chat_id);
			} else {
				RETURN_ECODE(13);
				RETURN_FAILURE();
			}
		}
		else if (!empty($_GET["delete_chat"])) {
			
			PASSWD_CHECK();
			EXTENDED_CHAT_DATA_CHECK($chatrooms);
			LOGON_CHECK($users);
			$chat_id = $_GET["chat_id"];
			$privileges = "000";
			$chatter_id = 0;
			$uid = -1;
			foreach ($users as &$user) {
				if ($user["USERNAME"] == $_GET["username"]) {
					$uid = $user["ID"];
				}
			}
			foreach ($chatters as &$chatter) {
				if (($chatter["CHAT_ID"] == $chat_id) && ($chatter["MEMBER_ID"] == $uid)) {
					$privileges = $chatter["PRIVILEGES"];
					foreach ($users as &$user) {
						if ($uid == $chatter["MEMBER_ID"]) {
							$chatter_id = $chatter["ID"];
						}
					}
				}
			}
			if ($chatter_id == 0) {
				RETURN_ECODE(10);
				RETURN_FAILURE();
			}
			if (($privileges == "111") || ($privileges == "101") || ($privileges == "011") || ($privileges == "001")) {
				// Eliminate any foreign key constraints
				SQL_EXECUTE($connection, "DELETE FROM messages WHERE CHAT_ID = " . $chat_id);
				SQL_EXECUTE($connection, "DELETE FROM chatters WHERE CHAT_ID = " . $chat_id);
				// Delete chat
				SQL_EXECUTE($connection, "DELETE FROM chatrooms WHERE ID = " . $chat_id);
			} else {
				RETURN_ECODE(11);
				RETURN_FAILURE();
			}
		} else if (!empty($_GET["logoff"])) {
			PASSWD_CHECK();
			EXTENDED_CHAT_DATA_CHECK($chatrooms);
			LOGON_CHECK($users);
			$chat_id = $_GET["chat_id"];
			$privileges = "000";
			$chatter_id = 0;
			$uid = -1;
			$owner = -1;
			foreach ($chatrooms as &$chatroom) {
				if ($chatroom["ID"] == $chat_id) {
					$owner = $chatroom["OWNER_ID"];
				}
			}
			foreach ($users as &$user) {
				if ($user["USERNAME"] == $_GET["username"]) {
					$uid = $user["ID"];
				}
			}
			foreach ($chatters as &$chatter) {
				if (($chatter["CHAT_ID"] == $chat_id) && ($chatter["MEMBER_ID"] == $uid)) {
					$privileges = $chatter["PRIVILEGES"];
					foreach ($users as &$user) {
						if ($uid == $chatter["MEMBER_ID"]) {
							$chatter_id = $chatter["ID"];
						}
					}
				}
			}
			if ($chatter_id == 0) {
				RETURN_ECODE(10);
				RETURN_FAILURE();
			}
			if (($privileges == "111") || ($privileges == "101") || ($privileges == "011") || ($privileges == "001")) {
				// Eliminate any foreign key constraints
				if ($owner == $uid) {
					SQL_EXECUTE($connection, "INSERT INTO messages (CHAT_ID, MESSAGE) VALUES (" . $chat_id . ", \"" . $_GET["username"] . " left the chat\");");
				} else {
					SQL_EXECUTE($connection, "INSERT INTO messages (CHAT_ID, MESSAGE) VALUES (" . $chat_id . ", \"Chat owner has left\");");
				}
			}
		}
		else if (!empty($_GET["find_chat"])) {
			PASSWD_CHECK();
			CHAT_DATA_CHECK($chatrooms);
			LOGON_CHECK($users);
			$chat_name = $_GET["chat_name"];
			foreach ($chatrooms as &$chatroom) {
				if ($chatroom["NAME"] == $_GET["chat_name"]) {
					echo "set /a success=1\r\n";
					echo "set /a chat_id=" . $chatroom["ID"] . "\r\n";
					echo "set /a encrypted=" . $chatroom["ENCRYPTED"] . "\r\n";
					return;
				}
			}
			RETURN_ECODE(12);
			RETURN_FAILURE();
		}
		else if (!empty($_GET["set_privileges"])) {
			PASSWD_CHECK();
			EXTENDED_CHAT_DATA_CHECK($chatrooms);
			LOGON_CHECK($users);
			if (empty($_GET["chat_id"]) || empty($_GET["target"]) || empty($_GET["privileges"])) {
				RETURN_ECODE(17);
				RETURN_FAILURE();
			}
			$chat_id = $_GET["chat_id"];
			$privileges = "000";
			$chatter_id = 0;
			$uid = -1;
			$target_chatter = $_GET["target"];
			if (str_replace("0", "", str_replace("1", "", $target_chatter)) != "") {
				RETURN_ECODE(18);
				RETURN_FAILURE();
			}
			$target_privileges = $_GET["privileges"];
			$target_id = -1;
			$owner = -1;
			foreach ($chatrooms as &$chatroom) {
				if ($chatroom["ID"] == $chat_id) {
					$owner = $chatroom["OWNER_ID"];
				}
			}
			foreach ($users as &$user) {
				if ($user["USERNAME"] == $_GET["username"]) {
					$uid = $user["ID"];
				} else if ($user["USERNAME"] == $_GET["target_chatter"]) {
					$target_id = $user["ID"];
				}
			}
			if ($target_id == $owner) {
				RETURN_ECODE(16);
				RETURN_FAILURE();
			}
			if ($target_id == $uid) {
				RETURN_ECODE(15);
				RETURN_FAILURE();
			}
			if ($target_id == -1) {
				RETURN_ECODE(17);
				RETURN_FAILURE();
			}
			foreach ($chatters as &$chatter) {
				if (($chatter["CHAT_ID"] == $chat_id) && ($chatter["MEMBER_ID"] == $uid)) {
					$privileges = $chatter["PRIVILEGES"];
					foreach ($users as &$user) {
						if ($uid == $chatter["MEMBER_ID"]) {
							$chatter_id = $chatter["ID"];
						}
					}
				}
			}
			foreach ($chatters as &$chatter) {
				if (($chatter["CHAT_ID"] == $chat_id) && ($chatter["MEMBER_ID"] == $uid)) {
					$privileges = $chatter["PRIVILEGES"];
					foreach ($users as &$user) {
						if ($uid == $chatter["MEMBER_ID"]) {
							$chatter_id = $chatter["ID"];
						}
					}
				}
			}
			if ($chatter_id == 0) {
				RETURN_ECODE(10);
				RETURN_FAILURE();
			}
			if (($privileges == "111") || ($privileges == "101") || ($privileges == "011") || ($privileges == "001")) {
				SQL_EXECUTE($connection, "UPDATE CHATTERS SET PRIVILEGES = " . $target_privileges . " WHERE ID = " . $target_id . ";");
				if ($owner == $uid) {
					SQL_EXECUTE($connection, "INSERT INTO messages (CHAT_ID, MESSAGE) VALUES (" . $chat_id . ", \"Chat owner updated chat privileges for " . $target_chatter . "\");");
				} else {
					SQL_EXECUTE($connection, "INSERT INTO messages (CHAT_ID, MESSAGE) VALUES (" . $chat_id . ", \"" . str_replace("Chat owner", "Some idiot, who is trying to impersonate the chat owner,", $_GET["username"]) . " updated chat privileges for " . $target_chatter . "\");");
				}
			}
		}
		else if (!empty($_GET["join"])) {
			PASSWD_CHECK();
			EXTENDED_CHAT_DATA_CHECK($chatrooms);
			LOGON_CHECK($users);
			$chat_id = $_GET["chat_id"];
			$uid = -1;
			$owner = -1;
			foreach ($chatrooms as &$chatroom) {
				if ($chatroom["ID"] == $chat_id) {
					$owner = $chatroom["OWNER_ID"];
				}
			}
			foreach ($users as &$user) {
				if ($user["USERNAME"] == $_GET["username"]) {
					$uid = $user["ID"];
				}
			}
			$privileges = "000";
			$chatter_id = 0;
			foreach ($chatters as &$chatter) {
				if (($chatter["CHAT_ID"] == $chat_id) && ($chatter["MEMBER_ID"] == $uid)) {
					$privileges = $chatter["PRIVILEGES"];
					foreach ($users as &$user) {
						if ($uid == $chatter["MEMBER_ID"]) {
							$chatter_id = $chatter["ID"];
						}
					}
				}
			}
			if ($chatter_id == 0) {
				SQL_EXECUTE($connection, "INSERT INTO CHATTERS (MEMBER_ID, CHAT_ID, PRIVILEGES) VALUES (" . $uid . ", " . $chat_id . ", 100);");
				if ($owner == $uid) {
					SQL_EXECUTE($connection, "INSERT INTO messages (CHAT_ID, MESSAGE) VALUES (" . $chat_id . ", \"Chat owner created the chat\");");
				} else {
					SQL_EXECUTE($connection, "INSERT INTO messages (CHAT_ID, MESSAGE) VALUES (" . $chat_id . ", \"" . str_replace("Chat owner", "Some idiot, who is trying to impersonate the chat owner,", $_GET["username"]) . " has joined the chat\");");
				}
			} else {
				if ($owner == $uid) {
					SQL_EXECUTE($connection, "INSERT INTO messages (CHAT_ID, MESSAGE) VALUES (" . $chat_id . ", \"Chat owner has returned\");");
				} else {
					SQL_EXECUTE($connection, "INSERT INTO messages (CHAT_ID, MESSAGE) VALUES (" . $chat_id . ", \"" . str_replace("Chat owner", "Some idiot, who is trying to impersonate the chat owner,", $_GET["username"]) . " has returned to chat\");");
				}
			}
		} else if (!empty($_GET["update_check"])) {
			if (empty($_GET["version"])) {
				RETURN_ECODE(19);
				RETURN_FAILURE();
			}
			if ($_GET["version"] == $latest_version) {
				echo "set \"update_available=false\"\r\n";
				echo "set /a success=1\r\n";
			} else {
				echo "set \"update_available=true\"\r\n";
				echo "set \"update_url=/chatroom/client\"\r\n";
				echo "set /a success=1\r\n";
			}
		} else if (!empty($_GET["upload_attachment"])) {
			if (empty($_GET["filename"]) || empty($_GET["name"]) || empty($_GET["content"])) {
				RETURN_ECODE(20);
				RETURN_FAILURE();
			}
			PASSWD_CHECK();
			EXTENDED_CHAT_DATA_CHECK($chatrooms);
			LOGON_CHECK($users);
			$chat_id = $_GET["chat_id"];
			$uid = -1;
			$owner = -1;
			foreach ($chatrooms as &$chatroom) {
				if ($chatroom["ID"] == $chat_id) {
					$owner = $chatroom["OWNER_ID"];
				}
			}
			foreach ($users as &$user) {
				if ($user["USERNAME"] == $_GET["username"]) {
					$uid = $user["ID"];
				}
			}
			$privileges = "000";
			$chatter_id = 0;
			foreach ($chatters as &$chatter) {
				if (($chatter["CHAT_ID"] == $chat_id) && ($chatter["MEMBER_ID"] == $uid)) {
					$privileges = $chatter["PRIVILEGES"];
					foreach ($users as &$user) {
						if ($uid == $chatter["MEMBER_ID"]) {
							$chatter_id = $chatter["ID"];
						}
					}
				}
			}
			$attachments = 0;
			$total_size = 0;
			$server_size = 0;
			$server_total = 0;
			foreach ($attachments as &$attachment) {
				if ($attachment["FILENAME"] == $_GET["filename"]) {
					RETURN_ERROR(22);
				}
				if ($attachment["UPLOADER_ID"] == $uid) {
					$attachments += 1;
					$total_size += filesize($_SERVER["DOCUMENT_ROOT"] . "/chatroom/attachments/" . $attachment["FILENAME"]);
				}
				$server_size += filesize($_SERVER["DOCUMENT_ROOT"] . "/chatroom/attachments/" . $attachment["FILENAME"]);
				$server_total += 1;
			}
			$path = $_SERVER["DOCUMENT_ROOT"] . "/chatroom/attachments/" . $_GET["filename"];
			if (strlen($_GET["content"]) > $line_quota) { RETURN_ERROR(23);	}
			if (filesize($path) > $size_quota) { RETURN_ERROR(24); }
			if ($attachments > $user_quota) { RETURN_ERROR(25); }
			if ($total_size > $user_size_quota) { RETURN_ERROR(26);	}
			if ($server_size > $server_quota) {	RETURN_ERROR(27); }
			if ($server_total > $server_count_quota) { RETURN_ERROR(28); }
			if (!file_exists($path)) {
				$openfile = fopen($path, "w") or RETURN_ERROR(21);
				$line = $_GET["content"] . "\r\n";
				fwrite($path, $line);
				fclose($path);
				$name = $_GET["name"];
				$fname = $_GET["filename"];
				SQL_EXECUTE($connection, "INSERT INTO attachments (NAME, FILENAME, CHAT_ID, UPLOADER_ID) VALUES (\"{$name}\", \"{$fname}\", {$chat_id}, {$uid})");
				echo "set /a success=1\r\n";
			} else {
				$openfile = fopen($path, "a") or RETURN_ERROR(21);
				$line = $_GET["content"] . "\r\n";
				fwrite($path, $line);
				fclose($path);
				echo "set /a success=1\r\n";
			}
		} else if (!empty($_GET["send_attachment"])) {
			PASSWD_CHECK();
			EXTENDED_CHAT_DATA_CHECK($chatrooms);
			LOGON_CHECK($users);
			$chat_id = $_GET["chat_id"];
			$uid = -1;
			$owner = -1;
			foreach ($chatrooms as &$chatroom) {
				if ($chatroom["ID"] == $chat_id) {
					$owner = $chatroom["OWNER_ID"];
				}
			}
			foreach ($users as &$user) {
				if ($user["USERNAME"] == $_GET["username"]) {
					$uid = $user["ID"];
				}
			}
			$privileges = "000";
			$chatter_id = 0;
			foreach ($chatters as &$chatter) {
				if (($chatter["CHAT_ID"] == $chat_id) && ($chatter["MEMBER_ID"] == $uid)) {
					$privileges = $chatter["PRIVILEGES"];
					foreach ($users as &$user) {
						if ($uid == $chatter["MEMBER_ID"]) {
							$chatter_id = $chatter["ID"];
						}
					}
				}
			}
			SQL_EXECUTE($connection, "INSERT INTO CHATTERS (MEMBER_ID, CHAT_ID, PRIVILEGES) VALUES (" . $uid . ", " . $chat_id . ", 100);");
			if ($owner == $uid) {
				SQL_EXECUTE($connection, "INSERT INTO messages (CHAT_ID, MESSAGE) VALUES (" . $chat_id . ", \"Chat owner sent an attachment\");");
			} else {
				SQL_EXECUTE($connection, "INSERT INTO messages (CHAT_ID, MESSAGE) VALUES (" . $chat_id . ", \"" . str_replace("Chat owner", "Some idiot, who is trying to impersonate the chat owner,", $_GET["username"]) . " sent an attachment\");");
			}
		} else if (!empty($_GET["my_attachments"])) {
			PASSWD_CHECK();
			LOGON_CHECK($users);
			$uid = -1;
			foreach ($users as &$user) {
				if ($user["USERNAME"] == $_GET["username"]) {
					$uid = $user["ID"];
				}
			}
			$aid = 1;
			$totalcount = 0;
			$totalsize = 0;
			foreach ($attachments as &$attachment) {
				if ($attachment["UPLOADER_ID"] == $uid) {
					$aname = $attachment["NAME"];
					$afile = $attachment["FILENAME"];
					$asize = filesize($_SERVER["DOCUMENT_ROOT"] . "/chatroom/attachments/" . $afile);
					$chat_id = $attachment["CHAT_ID"];
					$achat = "";
					foreach ($chatrooms as &$chatroom) {
						if ($chatroom["ID"] == $chat_id) {
							echo "set \"chat{$aid}=" . $chatroom["NAME"] . "\"\r\n";
						}
					}
					echo "set \"name{$aid}={$aname}\"\r\n";
					echo "set \"file{$aid}={$afile}\"\r\n";
					echo "set \"size{$aid}={$asize}\"\r\n";
					echo "set \"_id{$aid}=" . $attachment["ID"] . "\"\r\n";
					$aid += 1;
					$totalcount += 1;
					$totalsize += $asize;
				}
			}
			echo "set /a totalcount={$totalcount}\r\n";
			echo "set /a totalsize={$totalsize}\r\n";
			echo "set /a user_size_quota={$user_size_quota}\r\n";
			echo "set /a user_quota={$user_quota}\r\n";
			echo "set /a success=1\r\n";
		} else if (!empty($_GET["delete_attachment"])) {
			PASSWD_CHECK();
			LOGON_CHECK($users);
			if (empty($_GET["a_id"])) {
				RETURN_ERROR(29);
			}
			$uid = -1;
			foreach ($users as &$user) {
				if ($user["USERNAME"] == $_GET["username"]) {
					$uid = $user["ID"];
				}
			}
			$deleted = false;
			foreach ($attachments as &$attachment) {
				if ($attachment["UPLOADER_ID"] == $uid) {
					if ($attachment["ID"] == $_GET["a_id"]) {
						SQL_EXECUTE($connection, "DELETE FROM attachments WHERE ID = " . $attachment["ID"]);
						$deleted = true;
					}
				}
			}
			if (!$deleted) {
				RETURN_ERROR(30);
			} else {
				echo("set /a success=1\r\n");
			}
		} else if (!empty($_GET["chat_attachments"])) {
			PASSWD_CHECK();
			EXTENDED_CHAT_DATA_CHECK($chatrooms);
			LOGON_CHECK($users);
			$chat_id = $_GET["chat_id"];
			$privileges = "000";
			$chatter_id = 0;
			if (empty($_GET["message"])) {
				RETURN_ECODE(9);
				RETURN_FAILURE();
			}
			$user_id = -1;
			foreach ($users as &$user) {
				if ($user["USERNAME"] == $_GET["username"]) {
					$user_id = $user["ID"];
				}
			}
			foreach ($chatters as &$chatter) {
				if (($chatter["CHAT_ID"] == $chat_id)) {
					$privileges = $chatter["PRIVILEGES"];
					foreach ($users as &$user) {
						if ($user_id == $chatter["MEMBER_ID"]) {
							$chatter_id = $chatter["ID"];
						}
					}
				}
			}
			if ($chatter_id == 0) {
				RETURN_ECODE(10);
				RETURN_FAILURE();
			}
			$aid = 1;
			foreach ($attachments as &$attachment) {
				if ($attachment["CHAT_ID"] == $chat_id) {
					$aname = $attachment["NAME"];
					$afile = $attachment["FILENAME"];
					$uploader_id = $attachment["UPLOADER_ID"];
					$achat = "";
					foreach ($members as &$member) {
						if ($member["ID"] == $uploader_id) {
							echo "set \"uploader{$aid}=" . $member["USERNAME"] . "\"\r\n";
						}
					}
					echo "set \"name{$aid}={$aname}\"\r\n";
					echo "set \"file{$aid}={$afile}\"\r\n";
					echo "set \"id{$aid}=" . $attachment["ID"] . "\"\r\n";
					$aid += 1;
				}
			}
			echo "set /a success=1\r\n";
		}
	}
?>