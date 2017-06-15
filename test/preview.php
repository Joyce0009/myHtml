<!DOCTYPE html>
<html>
    <script src="jquery-3.2.1.min.js"></script>
    <script type="text/javascript">
        // Using jQuery to preivew image
        function filePreview(input) {
            if (input.files && input.files[0]) {
                var reader = new FileReader();
                reader.onload = function(e) {
                    showImageDimen(e.target.result);
                    $('#preview').css("display", "inline");
                    $('#imagePreview').attr('src', e.target.result);
                };
                var file = input.files[0];
                reader.readAsDataURL(file);
                showFileInfo(file);
            }
        }

        function removeFile() {
            $('#preview').css("display", "none");
            $('#fileToUpload').val("");
        }

        function showFileInfo(file) {
            $('#filename').text(file.name);
            $('#type').text(file.type);
            $('#size').text((file.size*0.00000095367432).toFixed(2));
        }

        function showImageDimen(src) {
            var img = new Image();
            img.onload = function() {
               $('#dimension').text(this.width + 'x' + this.height);
            };
            img.src = src;
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
                                        <tr><th>Filename</th>
                                            <th>Type</th>
                                            <th>WxH(px)</th>
                                            <th>Size(MB)</th>
                                        </tr>
                                        <tr><td><span id="filename"></td>
                                            <td><span id="type"></td>
                                            <td><span id="dimension"></td>
                                            <td><span id="size"></td>
                                        </tr>
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