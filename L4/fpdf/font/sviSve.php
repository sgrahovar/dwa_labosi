<?php
  include ("util.php");
 $sviPredmetiSviStudenti=getfromdb("select upisanipredmeti.idpredmeta, predmeti.naziv, upisanipredmeti.jmbagstudenta, studenti.ime, studenti.prezime  from upisanipredmeti left join predmeti on (predmeti.idpred=upisanipredmeti.idpredmeta) right join studenti on (upisanipredmeti.jmbagstudenta=studenti.jmbag) order by upisanipredmeti.idpredmeta asc,studenti.prezime asc, studenti.ime asc");
 
?>
<table>
<tr>
  <td> Sif
  </td>
  <td> Predmet
  </td>
  <td> JMBAG
  </td>
  <td> Ime
  </td>
  <td> Prezime
  </td>
</tr>  

<?php
  foreach $sviPredmetiSviStudenti as $jedanPredmetJedanStudent)
  {
    echo '<tr><td>'.$jedanPredmetJedanStudent['idpredmeta'].'</td><td>'.$jedanPredmetJedanStudent['naziv'].'</td><td>'.$jedanPredmetJedanStudent['jmbagstudenta'].'</td><td>'.$jedanPredmetJedanStudent['ime'].'</td><td>'.$jedanPredmetJedanStudent['prezime'].'</td></tr>';
  
  
  }


?> 
 
 
</table>  
