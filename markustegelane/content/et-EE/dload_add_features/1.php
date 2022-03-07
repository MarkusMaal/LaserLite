<h1>Allalaadimise lisamine</h1>
<p style="color: red; font-size: 16pt;">Hoiatus: See liides pole mõeldud tavakasutajatele. Kui olete tavakasutaja, SULGEGE SEE LEHT KOHE!</p>
<p style="color: yellow;">Allalaadimise lisamisel ei tohi ühtegi järgnevat etappi vahele jätta. Vastasel korral on üksus allalaadimise lehel rikutud.</p>
<ol>
<li style="font-weight: bold;">Tekstipõhiste metaandmete lisamine</li>
<li>Allalaadimise linkide lisamine</li>
<li>Pisipiltide lisamine</li>
</ol>
<form name="form1" action="?doc=dload_add_features&s=2" method="post">
<table>
<tr>
<td>Kategooria<span style="color: #f00">*</span></td>
<td><select name="dtype">
    <option value="1" selected>Pakkfailid</option>
    <option value="2">PowerPoint</option>
    <option value="3">Markuse tarkvara</option>
    <option value="4">Taustapildid</option>
    <option value="5">Muu</option>
</select></td>
</tr>
<tr>
<td>Pealkiri (et-EE)<span style="color: #f00">*</span></td>
<td><input name="etTitle" type="text"></input></td>
</tr>
<tr>
<td>Kirjeldus (et-EE)</td>
<td><textarea name="etDescription"></textarea></td>
</tr>
<tr>
<td>Pealkiri (en-US)</td>
<td><input name="enTitle" type="text"></input></td>
</tr>
<tr>
<td>Kirjeldus (en-US)</td>
<td><textarea name="enDescription"></textarea></td>
</tr>
</table>
<input type="submit" value="Jätka"></input>
</form>
