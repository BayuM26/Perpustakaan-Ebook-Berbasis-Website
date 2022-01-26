<?php
    session_start();
    if($_SESSION['status']!='login')
        {
            header('Location:index.php?masuk="paksaan_masuk"');	
        }
?>

<!doctype html>
<html lang="en">
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>Ebook</title>
  <script src="http://cdnjs.cloudflare.com/ajax/libs/pdf.js/2.0.943/pdf.min.js"></script>
  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.6.1/font/bootstrap-icons.css">
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">
  <link rel="stylesheet" href="https://www.w3schools.com/w3css/4/w3.css">
  <link rel="stylesheet" href="lib/CSS/viewebook.css">
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-ka7Sk0Gln4gmtz2MlQnikT1wXgYsOg+OMhuP+IlRH9sENBO0LRn5q+8nbTov4+1p" crossorigin="anonymous"></script>
  <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.10.2/dist/umd/popper.min.js" integrity="sha384-7+zCNj/IqJ95wo16oMtfsKbZ9ccEh31eOz1HGyDuCQ6wgnyJNSYdrPa03rtR1zdB" crossorigin="anonymous"></script>
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.min.js" integrity="sha384-QJHtvGhmr9XOIpI6YVutG+2QOK9T+ZnN4kzFN1RtK3zEFEIsxhlmWl5/YESvpZ13" crossorigin="anonymous"></script>
</head>
<body>

    <div>
        <a class="btn btn-outline-primary" href="tampilanebook.php?idbook= <?php echo $_SESSION['id_book'] ?>"><i class="bi bi-arrow-left-square-fill"></i></a>
    </div>

     <div id="my_pdf_viewer">
        <div id="canvas_container">
            <canvas id="pdf_renderer"></canvas>
        </div>
        
        <div class="row">
            <div class="ms-lg-5 col-sm-4">  
                <div class="row">
                    <div class="col-sm-6">
                        <div id="zoom_controls">
                            <button class="btn btn-outline-primary" id="zoom_in">+</button>
                            <label for="" style="color:#ffffff;">ZOOM</label>
                            <button class="btn btn-outline-primary" id="zoom_out">-</button>
                        </div>
                    </div>
                </div>
            </div>

            <div class="w3- col-sm-6">  
                <div id="navigation_controls">
                    <div class="row">    
                        <div class="col-sm-2">
                            <button class="btn btn-outline-primary" id="go_previous">Previous</button>
                        </div>

                        <div class="col-sm-2">
                            <input class="form-control" id="current_page" value="1" type="number"/>
                        </div>

                        <div class="col-sm-1 ">
                            <button class="btn btn-outline-primary" id="go_next">Next</button>
                        </div>
                    </div>
                </div>
            </div>
    </div>

    <script>
        var myState = {
            pdf: null,
            currentPage: 1,
            zoom: 1
        }
     
        pdfjsLib.getDocument('fileUpload/file ebook/<?php echo"{$_GET['namaEbook']}";?>').then((pdf) => {
     
            myState.pdf = pdf;
            render();

        });

        function render() {
            myState.pdf.getPage(myState.currentPage).then((page) => {
         
                var canvas = document.getElementById("pdf_renderer");
                var ctx = canvas.getContext('2d');
     
                var viewport = page.getViewport(myState.zoom);

                canvas.width = viewport.width;
                canvas.height = viewport.height;
         
                page.render({
                    canvasContext: ctx,
                    viewport: viewport
                });
            });
        }

        document.getElementById('go_previous').addEventListener('click', (e) => {
            if(myState.pdf == null || myState.currentPage == 1) 
              return;
            myState.currentPage -= 1;
            document.getElementById("current_page").value = myState.currentPage;
            render();
        });

        document.getElementById('go_next').addEventListener('click', (e) => {
            if(myState.pdf == null || myState.currentPage > myState.pdf._pdfInfo.numPages) 
               return;
            myState.currentPage += 1;
            document.getElementById("current_page").value = myState.currentPage;
            render();
        });

        document.getElementById('current_page').addEventListener('keypress', (e) => {
            if(myState.pdf == null) return;
         
            // Get key code
            var code = (e.keyCode ? e.keyCode : e.which);
         
            // If key code matches that of the Enter key
            if(code == 13) {
                var desiredPage = 
                document.getElementById('current_page').valueAsNumber;
                                 
                if(desiredPage >= 1 && desiredPage <= myState.pdf._pdfInfo.numPages) {
                    myState.currentPage = desiredPage;
                    document.getElementById("current_page").value = desiredPage;
                    render();
                }
            }
        });

        // zoom
        document.getElementById('zoom_in').addEventListener('click', (e) => {
            if(myState.pdf == null) return;
            myState.zoom += 0.2;
            render();
        });

        document.getElementById('zoom_out').addEventListener('click', (e) => {
            if(myState.pdf == null) return;
            myState.zoom -= 0.2;
            render();
        });
        //end zoom
    </script>
</body>
</html>