<!DOCTYPE html>
<html>
    <script src="jquery-3.2.1.min.js"></script>
    <script type="text/javascript">
        // Using jQuery to preivew image
        function filePreview(input) {
            if (input.files && input.files[0]) {
                var reader = new FileReader();
                reader.onload = function(e) {
                    $('#preview').css("display", "block");
                    $('#imagePreview').attr('src', e.target.result);
                };
                reader.readAsDataURL(input.files[0]);
            }
        }

        function removeFile() {
            $('#preview').css("display", "none");
            $('#fileToUpload').val("");
        }
    </script>
    <style>
        #preview {
            width: 140px;
            display: none;
            position: relative;
        }
        #imagePreview {
            width: 140px;
            border: 1px solid #e4d3c3;
            padding: 8px;
            float: left;
        }
        #deleteimg {
            cursor: pointer;
            width: 30px;
            position: absolute;
            top: -15px;
            right: -35px;
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