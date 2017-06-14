<!DOCTYPE html>
<html>
    <script src="jquery-3.2.1.min.js"></script>
    <script type="text/javascript">
        // Using jQuery to preivew image
        function filePreview(input) {
            if (input.files && input.files[0]) {
                var reader = new FileReader();
                reader.onload = function(e) {
                    var img = new Image();
                    img.onload = function() {
                        console.log('w ' + this.width);
                        console.log('h ' + this.height);
                    };
                    img.src = e.target.result;
                    $('#preview').css("display", "inline");
                    $('#imagePreview').attr('src', e.target.result);
                };
                reader.readAsDataURL(input.files[0]);
                console.log('filename ' + input.files[0].name);
                console.log('size ' + input.files[0].size);
                console.log('type ' + input.files[0].type);
            }
        }

        function removeFile() {
            $('#preview').css("display", "none");
            $('#fileToUpload').val("");
        }
    </script>
    <style>
        table {
            font-family: arial, sans-serif;
            border-collapse: collapse;
            width: 100%;
        }
        td, th {
            border: 1px solid #badcff;
            text-align: left;
            padding: 8px;
        }
        tr:nth-child(even) {
            background-color: #d3e9ff
        }
        tr:nth-child(odd) {
            background-color:#ffffff;
        }
        #preview {
            width: 500px;
            display: none;
            position: relative;
        }
        #imagePreview {
            width: 100px;
            border: 1px solid #e4d3c3;
            padding: 8px;
            float: left;
            display: inline-block;
        }
        #deleteimg {
            cursor: pointer;
            width: 30px;
            position: absolute;
            top: -15px;
            right: -15px;
        }
        #imageInfo {
            width: 100%;
            font-family: arial, sans-serif;
            position: absolute;
            display: inline-block;
            border-collapse: collapse;
            padding-left: 30px;
        }
    </style>
    <body>
        <h1>Image Preview</h1>
        <form action="action_page.php" method="post" enctype="multipart/form-data" id="uploadForm">
            <table>
                <tr>
                    <td>Upload Drawable File</td>
                    <td>
                        <fieldset>
                            <legend>Select image to upload:</legend>
                            <input onchange="filePreview(this);" type="file" accept="image/*" name="fileToUpload" id="fileToUpload">
                            <br><br>
                        </fieldset>
                        <fieldset>
                            <legend>Drawable Preview:</legend>
                            <div id="preview">
                                <img id="imagePreview" src="">
                                <img id="deleteimg" src="delete.png" onclick="removeFile();">
                                <div id="imageInfo">
                                    <table>
                                        <tr><th>Type</th><th>Size(MB)</th><th>W/H(px)</th><th>Filename</th></tr>
                                        <tr><td>png</td><td>10</td><td>1280/1920</td><td>123.png</td></tr>
                                    </table>
                                </div>
                            </div>
                        </fieldset>
                   </td>
                </tr>
                <tr>
                    <td style="text-align:center" colspan="2">
                        <input type="submit" value="Submit">
                    </td>
                </tr>
            </table>
        </form>
        <?php include 'footer.php';?>
    </body>
</html>