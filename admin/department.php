<select class="form-control" name="depname" onchange="change_depname()" id="depname_id">
      <option>*select department*</option>
      <option value="Humanity">Humanity</option>
    	<option value="Computer">Computer</option>
    	<option value="IT">IT</option>
    	<option value="Civil">Civil</option>
    	<option value="ETRX">ETRX</option>
    	<option value="EXTC">EXTC</option>
    </select>


    <select class="form-control" name="division" id="div">

</select>

<script type="text/javascript">
  function change_depname() {
    var xmlhttp=new XMLHttpRequest();
    xmlhttp.open("GET","getajax.php?depname="+document.getElementById("depname_id").value,false);
    xmlhttp.send(null);
    document.getElementById("div").innerHTML=xmlhttp.responseText;
  }
</script>