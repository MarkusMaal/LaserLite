<h1>Feedback</h1>
<p>Here you can send feedback and questions about the web site to admins. Your name and
password will be sent to the server and get encrypted before saving. This means that you
have to remember both your username and password, if you want to see answers from admin
to your questions. If you forget these login details, you'll have to enter new ones. Before
entering these details, make sure your connection is secure and that sertificates are from
Cloudflare (with the exception if you're developing the web site).</p>
<p>Your login details are not viewable in the database, since they get encrypted before
getting saved. This means that the administrator can not, in any way, log into your
account. Sent messages and nicknames in these messages are only visible to administrators.
</p>
<p>Username is visible only to you. After logging out, it'll be forgotten and
restored when you log in again.</p>
<p>In addition to sending feedback, you can do the following: </p>
<ul>
<li>Ask full deletion of data from the database, that cannot be deleted through normal interfaces (these include
login details used to log in here)</li>
<li>Ask what kind of data about you exists in the database</li>
<li>Notify about mistranslation/grammatical errors</li>
<li>Comment about the user experience</li>
<li>Create a moderator account (<a href="?doc=feedback&s=3">instructions</a>)</li>
<li>Notify about viruses or broken links</li>
</ul>

<p>Example, how login details are stored in the database (random data, not actual data):</p>
<hr/><table>
<tr style="background: #555;">
<th>ID</th>
<th>CRYPTCODE</th>
</tr>
<tr>
<td>1</td>
<td>2e56ce57c397c5374b3b538cdb3fe153</td>
</tr>
<tr>
<td>2</td>
<td>26dd01f15b2d1abcd73fc40ea4ce7b2b</td>
</tr>
<tr>
<td>3</td>
<td>05d9a930e3450967cc3ff1097bc6e0e6</td>
</tr>
</table><hr/><br/>
<form action="?doc=feedback&s=2" method="post">
	<table>
		<tr>
			<td style="text-align: right;">Username: </td>
			<td><input name="name"></input></td>
		</tr>
		<tr>
			<td style="text-align: right;">Password: </td>
			<td><input type="password" name="pass"></input></td>
		</tr>
	</table><br/>
	<input type="submit" value="Enter"></input>
</form>
