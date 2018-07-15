
  <!DOCTYPE html>
  <html lang="en">
  <head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>CSV array</title>
  </head>
  <body>
    <form action="uploadcsv.php" method="post" enctype="multipart/form-data" >
      <h2>CSV=>PHP array変換君㌼ </h2>
      <p>いろんな配列形式に変換します</p>
      <span>CSVファイル :</span>
      <input type="file" name="csvfile" size="30" />
      <br />
      <br />
      <span>（漢字などが文字化けするとき）ExcelのCSV(ShiftJIS)の場合 :</span>
      <input type="checkbox" name="excel" value="excel">
      <br />
      CSV1行目をkeyとして変換、指定idを多次元配列のkeyにする :
      <input type="checkbox" name="csvkey" value="csvkey">
      id : <input type="text" name="keyid" value="">
      <br/>
      <br />
      <span>出力方法 :</span>
      <select name="vartype" size="4">
      	<option value="varexport" selected>var_export</option>
        <option value="jsonencode">json_encode</option>
      	<option value="print">print</option>
      	<option value="vardump">var_dump</option>
      </select>
      <br />
      <br />
      <input type="submit" value="アップロード" />
    </form>
    <br />
    <p>PHPバージョン : <?php echo phpversion();?></p>
  </body>
  </html>
