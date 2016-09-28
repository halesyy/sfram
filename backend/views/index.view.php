<div style="padding:10px;">
  <h1>TODO:</h1> <br/>
  go to <b>config/config.php</b> and edit how you want, make sure to change your <b>key</b> and etc... <br/>
  go to <b>config/database.php</b> and set your auth <b>salt</b>, <b>hash key</b> and <b>database info</b> <br/>
  <b>(if you know what a data_string is, use that)</b> <br/>
  <br/>
  <b>(OPTIONAL)</b> go to <b>config/meta-config.php</b> if you enabled in your <b>config.php</b> and edit that for your website <br/>
  go to <b>backend/builds/create-page.build.php</b> and set your <b>AUTH_TOKEN</b> to something secure <br/>
  go to <b>domain/create-page</b> and put in the <b>AUTH_TOKEN</b> that you made and a new page</b> <br/>
  two files would have been made, bam! (<b>youll have to add the slug to your <i>routes.php</i></b>) <br><br/>

  <h3>PSM - databases</h3> <br/>
  the framework runs using a database-connection called <b>PSM - php scripting module (I dont know what to call it)</b> <br/>
  when your database information is filled out, you get two variables created: <br/>
  - <b>PSM</b> ($psm) - the class object for PSM, you can do many easy things using this class <br/>
  - <b>PDO</b> ($pdo) - the class object for PDO, just the normal PDO object you're used to but using you have given
</div>
