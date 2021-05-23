  <!DOCTYPE html>
  <html lang="en">
  <head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>CSV array</title>
    <link rel="stylesheet" type="text/css" href="//cdnjs.cloudflare.com/ajax/libs/bulma/0.7.2/css/bulma.min.css">
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.5.0/css/all.css" integrity="sha384-B4dIYHKNBt8Bc12p+WXckhzcICo0wtJAoU8YZTY5qE0Id1GSseTk6S+L3BlXeVIU" crossorigin="anonymous">
  </head>
  <body>
    <style type="text/css">
      .content {
        margin: 20px;
      }
      .file-name {
        min-width: 100px;
      }
      .input[name="keyid"] {
        width: 100px;
        height: 25px;
      }
      .output{
        line-height: 36px;
      }
      .button.is-link{
        margin: 0 0 0 16px;
      }
    </style>
    <div class="content">
      <form action="uploadcsv.php" method="post" enctype="multipart/form-data" >
        <h2>CSV => PHP array変換君㌼</h2>
        <p>いろんな配列形式に変換します</p>
        
        <div class="field">
          <div class="file is-primary has-name">
            <label class="file-label">
              <input id="file" class="file-input" type="file" name="csvfile">
              <span class="file-cta">
                <span class="file-icon">
                  <i class="fas fa-file-upload"></i>
                </span>
                <span class="file-label">
                  CSV file…
                </span>
              </span>
              <span id="filename" class="file-name">
              </span>
            </label>
          </div>
        </div>

        <br />
        <h4>OPTION</h4>
        <ul>
          <li>
            <span>
              ExcelのCSV(ShiftJIS)の場合 :
            </span>
            <input type="checkbox" name="excel" value="excel"><br />
            （漢字などが文字化けするとき）
          </li>
          <li>
            CSV1行目をkeyとして変換 : <input type="checkbox" name="csvkey" value="csvkey">
            <br />
            指定idのvalueを多次元配列のkeyにする : <input class="input" type="text" name="keyid" value="">
          </li>
        </ul>
        <br />
        <span class="output">出力方法 :</span>
        <div class="select">
          <select name="vartype">
          	<option value="varexport" selected>var_export</option>
          	<option value="varexportshort">var_export (short array)</option>
            <option value="jsonencode">json_encode</option>
          	<option value="print">print</option>
          	<option value="vardump">var_dump</option>
          </select>
        </div>
        <input class="button is-link" type="submit" value="UPLOAD" />
      </form>
      <br />
      <br />
      <br />
      <p>PHPバージョン : <?php echo phpversion();?></p>
    </div>
    <script>
      var file = document.getElementById("file");
      file.onchange = function() {
        if(file.files.length > 0) {
          document.getElementById('filename').innerHTML = file.files[0].name;
        }
      };
    </script>
  </body>
  </html>
