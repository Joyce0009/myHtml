<!DOCTYPE html>
<html>
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
    .error {
        color: #ff0000;
    }
    </style>
    <body>

    <h1>myAsus ToolSite</h1>
    <form action="action_page.php" method="post" enctype="multipart/form-data">
        <table>
            <tr>
                <th style="text-align:center" colspan="2">App Info</th>
            </tr>
            <tr>
                <td width="200">App Name</td>
                <td>vendor/app-prebuilt/data</td>
            </tr>
            <tr>
                <td>App Reviewer</td>
                <td>Chi-wen_Cheng@asus.com<br>Joyce_Lin@asus.com</td>
            </tr>
            <tr>
                <td>Upload Drawable File</td>
                <td>
                    <fieldset>
                        <legend>Select image to upload:</legend>
                        <input type="file" name="fileToUpload" id="fileToUpload">
                        <br><br>
                    </fieldset>
                    <fieldset>
                        <legend>Drawable Preview:</legend>
                        <a target="_blank" href="uploads/path2.jpg">
                            <img src="uploads/path2.jpg" alt="Forest" style="width:80px">
                        </a>
                    </fieldset>
               </td>
            </tr>
            <tr>
                <td>Author</td>
                <td>Joyce_lin(Joyce_Lin@asus.com)</td>
            </tr>
            <tr>
                <td>Title</td>
                <td>
                    <input type="text" name="title" value="<?php echo $title;?>">
                    <span class="error">* <?php echo $titleErr;?></span>
                </td>
            </tr>
            <tr>
                <td>Description</td>
                <td>
                    <textarea name="comment" rows="10" cols="100"><?php echo $comment;?>
                    </textarea>
                </td>
            </tr>
            <tr>
                <td style="text-align:center" colspan="2">
                    <table>
                        <tr>
                            <td width="50">No.</td>
                            <td>Branch</td>
                        </tr>
                        <tr>
                            <td >1.</td>
                            <td>
                                <input type="checkbox" name="branch" value="AMAX_android-7.0.0_r1_dev">AMAX_android-7.0.0_r1_dev
                            </td>
                        </tr>
                        <tr>
                            <td >2.</td>
                            <td>
                                <input type="checkbox" name="branch" value="AMAX_android-7.1.1_r1_dev">AMAX_android-7.1.1_r1_dev
                            </td>
                        </tr>
                    </table>
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