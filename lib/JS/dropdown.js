	// dropdown buku animation
    function bookFunc(){
        var book = document.getElementById("itemDropdownBook");
        
        
        if (book.className.indexOf("w3-show") == -1)
        { 
            book.className += " w3-show";
            book.previousElementSibling.className += " w3-light-blue";
        }

        else
        {
            book.className = book.className.replace(" w3-show", "");
            book.previousElementSibling.className = 
            book.previousElementSibling.className.replace(" w3-light-blue", "");
        }
    }
    // end dropdown buku animation

    // dorpdown admin animation
    function userFunc(){
        var user = document.getElementById("itemDropdownUser");

            
        if(user.className.indexOf("w3-show") == -1) 
        {
            user.className += " w3-show";
            user.previousElementSibling.className += " w3-light-blue"; 
        }

        else
        {
            user.className = user.className.replace(" w3-show", "");
            user.previousElementSibling.className = 
            user.previousElementSibling.className.replace(" w3-light-blue", "") 
        }
    }
    // end dropdown admin animation