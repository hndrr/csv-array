<!DOCTYPE html>
  <html lang="en">
  <head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>CSV array</title>
  </head>
  <body>
    <style type="text/css">
      textarea {
        margin: 20px 0px;
        padding: 10px;
        min-width: 400px;
        min-height: 600px;
        font-size: 16px;
      }
    </style>
    
    <p><?php
    setlocale(LC_ALL, 'ja_JP.UTF-8');

    if (is_uploaded_file($_FILES["csvfile"]["tmp_name"])) {
      $file_tmp_name = $_FILES["csvfile"]["tmp_name"];
      $file_name = $_FILES["csvfile"]["name"];

      if (substr($file_name, -4) =='.csv'){
        echo "MIME Type：" , $_FILES["csvfile"]["type"] , "<br />";
        echo "FileSize：" , $_FILES["csvfile"]["size"] , "<br />";
        echo "Temp file Name：" , $_FILES["csvfile"]["tmp_name"] , "<br />";
        echo "Error Code：" , $_FILES["csvfile"]["error"] , "<br />";

        $file = $_FILES["csvfile"]["tmp_name"];
        echo "Encoding：" , mb_detect_encoding($file) , "<br />";

        $fp  = fopen($file, "r");
        rewind($fp);

        if (isset($_POST['csvkey'])) {
          $titles = fgetcsv($fp);
          //Excelで作ったcsvまたはjson出力の場合変換
          if (isset($_POST['excel']) || isset($_POST['vartype']) == 'jsonencode') {
            mb_convert_variables("UTF-8", "SJIS", $titles);
          }
          while($line = fgetcsv($fp)) {
            //Excelで作ったcsvまたはjson出力の場合変換
            if (isset($_POST['excel']) || isset($_POST['vartype']) == 'jsonencode') {
              mb_convert_variables("UTF-8", "SJIS", $line);
            }
            $res[] = array_combine($titles, $line);
          }
        }else{
          while($line = fgetcsv($fp)) {
            //Excelで作ったcsvまたはjson出力の場合変換
            if (isset($_POST['excel']) || isset($_POST['vartype']) == 'jsonencode') {
              mb_convert_variables("UTF-8", "SJIS", $line);
            }
            $res[] = $line;
          }
        }

       //出力形式
       if(isset($_POST['vartype'])) {
         $sendform = $_POST['vartype'];
         
         if(isset($_POST['keyid'])) {
          $keyid = $_POST['keyid'];
         }
         
         //指定keyidで置換
         $array_column = array_column( $res, null, $keyid );

         if(isset($_POST['keyid'])) {
          //指定keyid列を削除
          function array_col_delete(&$row, $key, $keyid) {
            unset($row[$keyid]);
          }
          array_walk($array_column, "array_col_delete", $keyid);
         }
         
         switch ($sendform) {
           case 'varexport':
              print('<textarea>');
              var_export( $array_column );
              print('</textarea>');
              break;
           case 'print':
              print('<textarea>');
              print_r( $array_column );
              print('</textarea>');
              break;
           case 'jsonencode':
              print('<textarea>');
              print_r( json_encode( $array_column , JSON_PRETTY_PRINT | JSON_UNESCAPED_UNICODE|JSON_UNESCAPED_SLASHES) );
              print('</textarea>');
              break;
           case 'vardump':
              print('<pre>');
              var_dump( $array_column );
              print('</pre>');
              break;
         }
       }

       fclose($fp);

      } else {
        echo 'CSVファイルのみ対応しています。';
      }
    } else {
      echo "ファイルが選択されていません。";
    }
    ?></p>
  </body>
  </html>