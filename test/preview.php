<!DOCTYPE html>
<html>
    <script src="jquery-3.2.1.min.js"></script>
    <script type="text/javascript">
        var inputFileDimen = {"width": 0, "height": 0};

        // Using jQuery to preivew image
        function filePreview(input) {
            cleanCheckedResult();
            if (input.files && input.files[0]) {
                var reader = new FileReader();
                reader.onload = function(e) {
                    showImageDimen(e.target.result);
                    $('#preview').css("display", "inline");
                    $('#imagePreview').attr('src', e.target.result);
                };
                var file = input.files[0];
                reader.readAsDataURL(file);
                showAndCheckFileInfo(file);
                showAndCheckExpectedDimen();
            }
        }

        function cleanCheckedResult() {
            $('#filename_checked').css('display', "none");
            $('#type_checked').css('display', "none");
            $('#size_checked').css('display', "none");
            $('#dimension_checked').css('display', "none");
            $('#filename_errMeg').text("");
            $('#type_errMeg').text("");
            $('#size_errMeg').text("");
            $('#dimension_errMeg').text("");
            inputFileDimen = {"width": 0, "height": 0};
        }

        function removeFile() {
            $('#preview').css("display", "none");
            $('#fileToUpload').val("");
        }

        function showAndCheckFileInfo(file) {
            // show
            $('#filename').text(file.name);
            $('#type').text(file.type);
            // bytes to MB
            $('#size').text((file.size*0.00000095367432).toFixed(2));

            // check
            displayChecked(checkFileName(file.name), 'filename_checked', 'filename_errMeg');
            displayChecked(checkType(file.type), 'type_checked', 'type_errMeg');
            displayChecked(checkSize(file.size), 'size_checked', 'size_errMeg');
        }

        function checkFileName(filename) {
            // TODO check "default_wallpaper", "1a", "1"
            if (filename.startsWith("default_wallpaper")) {
                return 0;
            } else {
                return "Must starts with 'default_wallpaper'";
            }
        }

        function checkType(type) {
            if ("image/png" === type ) {
                return 0;
            } else {
                return "Must png type";
            }
        }

        function checkDimension(expectedW, expectedH, actualW, actualH) {
            expectedW = isString(expectedW) ? parseInt(expectedW) : expectedW;
            expectedH = isString(expectedH) ? parseInt(expectedH) : expectedH;
            actualW = isString(actualW) ? parseInt(actualW) : actualW;
            actualH = isString(actualH) ? parseInt(actualH) : actualH;
            if ( ((actualW >= (expectedW - 1)) && (actualW <= (expectedW + 1))) &&
                 ((actualH >= (expectedH - 1)) && (actualH <= (expectedH + 1))) ) {
                return 0;
            } else {
                return "Must (" + expectedW + "x" + expectedH + ")";
            }
        }

        function isString(toBeCheckedVar) {
            // jQuery.type()
            if ($.type(toBeCheckedVar) === "string") {
                return true;
            } else {
                return false;
            }
        }

        function checkSize(size) {
            // < 20 MB
            if (size < 20 * 1048576) {
                return 0;
            } else {
                return "Must < 20MB";
            }
        }

        function displayChecked(result, checkedID, errMsgID) {
            if (0 === result) {
                $('#' + checkedID).attr('src', 'checked.png');
                $('#' + checkedID).attr('style', 'width: 30px');
            } else {
                $('#' + errMsgID).text(result);
            }
        }

        function showImageDimen(src) {
            var img = new Image();
            img.onload = function() {
                inputFileDimen = {"width": this.width, "height": this.height};
                var expectedDimen = getExpectedDimen();
                $('#actual_dimension').text(inputFileDimen.width + 'x' + inputFileDimen.height);
                displayChecked(checkDimension(expectedDimen.width, expectedDimen.height, inputFileDimen.width, inputFileDimen.height),
                    'dimension_checked', 'dimension_errMeg');
            };
            img.src = src;
        }

        function getExpectedDimen() {
            var ratio = $('.resolution_ratio:checked').val();
            var raw_resolution = $('#resolution').val();
            var width = raw_resolution.split("_")[0] * ratio;
            var height = raw_resolution.split("_")[1] * ratio;
            return {"width": width.toFixed(0),  "height": height.toFixed(0)};
        }

        function showAndCheckExpectedDimen() {
            $('#dimension_checked').css('display', "none");
            $('#dimension_errMeg').text("");
            var expectedDimen = getExpectedDimen();
            $('#expected_dimension').text(expectedDimen.width + 'x' + expectedDimen.height);
            if (inputFileDimen.width > 0 && inputFileDimen.height > 0) {
                displayChecked(checkDimension(expectedDimen.width, expectedDimen.height, inputFileDimen.width, inputFileDimen.height),
                    'dimension_checked', 'dimension_errMeg');
            }
        }

        function onChangeResolution() {
            showAndCheckExpectedDimen();
        }
    </script>
    <style>
        table {
            font-family: arial, sans-serif;
            border-collapse: collapse;
            width: 100%;
        }
        th {
            border: 1px solid #badcff;
            text-align: center;
            padding: 8px;
        }
        td {
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
        .error {
            color: #ff0000;
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
                    <td style="width: 250px">Upload Drawable File</td>
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
                                            <th>Expected WxH(px)</th>
                                            <th>Actual WxH(px)</th>
                                            <th>Size(MB)</th>
                                        </tr>
                                        <tr><td><span id="filename"></td>
                                            <td><span id="type"></td>
                                            <td>
                                                <select id="resolution" onchange="onChangeResolution()">
                                                    <option value="720_1280">w720_h1280</option>
                                                    <option value="1080_1920" selected=>w1080_h1920</option>
                                                </select>
                                                <div>
                                                    <input type="radio" name="ratio" class="resolution_ratio" value ="1" onchange="onChangeResolution()">1
                                                    <input type="radio" name="ratio" class="resolution_ratio" value ="1.17" onchange="onChangeResolution()" checked>1.17
                                                </div>
                                                <div style="text-align: center;">
                                                    <span id="expected_dimension"></span>
                                                </div>
                                            </td>
                                            <td>
                                                <span id="actual_dimension"></span>
                                            </td>
                                            <td><span id="size"></td>
                                        </tr>
                                        <tr><td style="text-align: center">
                                                <img id="filename_checked">
                                                <span class="error" id="filename_errMeg"></span>
                                            </td>
                                            <td style="text-align: center">
                                                <img id="type_checked">
                                                <span class="error" id="type_errMeg"></span>
                                            </td>
                                            <td style="text-align: center" colspan="2">
                                                <img id="dimension_checked">
                                                <span class="error" id="dimension_errMeg"></span>
                                            </td>
                                            <td style="text-align: center">
                                                <img id="size_checked">
                                                <span class="error" id="size_errMeg"></span>
                                            </td>
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