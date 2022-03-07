<h1>Add a download</h1>
<p style="color: red; font-size: 16pt;">Warning: This interface is not meant for regular users. If you are a regular user, EXIT THIS PAGE NOW!</p>
<p style="color: yellow;">When adding a download you mustn't skip any step. Otherwise, downloadable item will be corrupt.</p>
<ol>
<li style="font-weight: bold;">Add text based metadata</li>
<li>Add download links</li>
<li>Add thumbnails</li>
</ol>
<form name="form1" action="?doc=dload_add_features&s=2" method="post">
<table>
<tr>
<td>Category<span style="color: #f00">*</span></td>
<td><select name="dtype">
    <option value="1" selected>Batch files</option>
    <option value="2">PowerPoint</option>
    <option value="3">Markus' stuff</option>
    <option value="4">Wallpapers</option>
    <option value="5">Other</option>
</select></td>
</tr>
<tr>
<td>Title (et-EE)<span style="color: #f00">*</span></td>
<td><input name="etTitle" type="text"></input></td>
</tr>
<tr>
<td>Description (et-EE)</td>
<td><textarea name="etDescription"></textarea></td>
</tr>
<tr>
<td>Title (en-US)</td>
<td><input name="enTitle" type="text"></input></td>
</tr>
<tr>
<td>Description (en-US)</td>
<td><textarea name="enDescription"></textarea></td>
</tr>
</table>
<input type="submit" value="Continue"></input>
</form>
