window.onload = () => {
    
    scrollMessageToBottom();
    allMessages();
    var idPersonne = sessionStorage.getItem("idPersonne");
    var nomPersonne = sessionStorage.getItem("nomPersonne");
    console.log(idPersonne +" "+ nomPersonne);

    const queryString = window.location.search;
    const urlParams = new URLSearchParams(queryString);

    const nameOther = urlParams.get("nomPersonne");
    const idOther = urlParams.get("idPersonne");
    console.log(idOther +" "+ nameOther);

!(function($) {
    
    $(document).on("submit", "#envoi-message", function (event) {
        event.preventDefault();
        addMessageList(".discussion-list", new FormData(this));
        scrollMessageToBottom();
        $("#envoi-message #mon-message").removeClass("active");
        $("#envoi-message textarea.form-control").val("");
        console.log(idPersonne +" "+ nomPersonne);
    });

    $(document).on("click", "button.delete", function() {
        let liste = $(this).attr("data-id");
        console.log(liste);
        if (confirm("voulez-vous vraiment supprimer ce message?") == true) {
            this.parentNode.parentNode.parentNode.parentNode.remove();
            removeMessage(liste);
        }
    });


    $(document).on("click", "button.edit", function() {
        var parentClass = this.parentNode.parentNode.parentNode;
        var childClass = parentClass.children[1].children[0];

        $("#envoi-message #mon-message").addClass("active");
        $("#envoi-message textarea.form-control").val($(this).attr("data"));
        $(childClass).html("");
        $(childClass).addClass("toEditActive");


        $(this).addClass("btnToEditActive");
    });

    $(document).on("mouseover", "button.edit", function() {
        $(this).addClass("edited");
        $("p.to-edit").addClass("active");
       
    });
    
    $(document).on("mouseleave", "button.edit", function() {
        $(this).removeClass("edit");
    });

})(jQuery);

estMoi = false;
function addMessageList(element, data) {
    var elementToActive = $("p.to-edit.toEditActive");

    if (elementToActive.length > 0) {
        $("p.to-edit.toEditActive").html(addLineBreaks(data.get("messageEnvoye")));
        elementToActive.removeClass("toEditActive");
        $("button.btnToEditActive").attr("data", addLineBreaks(data.get("messageEnvoye")));
        updateMessage($("button.delete").attr("data-id"), addLineBreaks(data.get("messageEnvoye")), 98);
        $("button.btnToEditActive").removeClass("btnToEditActive");
    } else {
        if (estMoi) {
            
            createMessage(addLineBreaks(data.get("messageEnvoye")), idPersonne);
  
        var html = `
        <li class="d-flex mb-4 justify-content-end">
            <div class="card mask-custom w-50 bg-primary borded-5">
                <div class="card-header d-flex justify-content-between p-3">
                <div class="m-0 small justify-content-center"> 
                    <p class="fw-bold m-0"> ${dayname} &middot ${jour} </p>
                </div>
                    <div class="m-0">
                        <button class="small btn btn-danger delete to-deleted" data="">
                            <i class="fa fa-trash"></i>    
                        </button>
                        <button class="small btn btn-warning edit" data="${ addLineBreaks(data.get("messageEnvoye")) }">
                            <i class="fa fa-edit"></i>    
                        </button>
                    </div>
                </div>
                <div class="card-body text-start">
                    <p class="mb-0 to-edit">
                        ${ addLineBreaks(data.get("messageEnvoye")) }
                    </p>
                </div>
            </div>
            <img src="http://localhost/message/img/chat.jpg" alt="avatar" width="10%" height="10%" class="rounded-circle mx-2">
        </li>
        `;
        } else {

        var html = `
            <li class="d-flex mb-4 justify-content-start">
                <img src="http://localhost/message/img/grenouille.jpg" alt="avatar" width="10%" height="10%" class="rounded-circle mx-2">
                <div class="card mask-custom w-50 bg-light borded-5 text-dark">
                    <div class="card-header d-flex justify-content-between p-3">
                        <p class="fw-bold mb-0">MAripitia</p>
                        <p class="small mb-0">
                            <i class="fa fa-clock">                    
                            </i>Il y a 5mn
                        </p>
                    </div>
                    <div class="card-body text-start">
                        <p class="mb-0">
                            ${ addLineBreaks(data.get("messageEnvoye")) }
                        </p>
                    </div>
                </div>
            </li>
        `;  
        }
        estMoi = !estMoi;
        $(element).append(html);
    }

} 

    var date = new Date();
    var jour = date.getDate();
    var day = date.getDay();
    var semaine = ['Dim', 'Lun', 'Mar', 'Mer', 'Jeu', 'Ven', 'Sam'];
    dayname = semaine[day];       

function allMessages() {
    var settings = {
    "url": "http://localhost/message/requetesPHP/curlGetMessages.php",
    "method": "GET",
    "timeout": 0,
    "processData": false,
    "mimeType": "multipart/form-data",
    "contentType": false,
    "dataType": "json",

    };

    $.ajax(settings).done(function (response) {
        $.each(response, function(key, value) {
            
            var html = "";
            if (value.Idpersonne === idPersonne) {
                html = `
                    <li class="d-flex mb-4 justify-content-end">
                        <div class="card mask-custom w-50 bg-primary borded-5 text-dark">
                            <div class="card-header d-flex justify-content-between p-3" data-date="${ value.Date }">
                                <div class="m-0 small justify-content-center"> 
                                    <p class="fw-bold m-0"> ${dayname} &middot ${jour} </p>
                                   
                                </div>
                                <div class="m-0">
                                    <button class="small btn btn-danger delete" data-id="${ value.IdMessages }">
                                        <i class="fa fa-trash"></i>    
                                    </button>
                                    <button class="small btn btn-warning edit" data="${ value.MpMoi }" data-idpersonne="${ value.idPersonne }">
                                        <i class="fa fa-edit"></i>    
                                    </button>
                                </div>
                            </div>
                            <div class="card-body text-start">
                                <p class="mb-0 to-edit">
                                    ${ addLineBreaks(value.MpMoi) }
                                </p>
                            </div>
                        </div>
                        <img src="http://localhost/message/img/chat.jpg" alt="avatar" width="10%" height="10%" class="rounded-circle mx-2">
                    </li>
                    `;
            } else if (value.Idpersonne === idOther){

                html = `
                    <li class="d-flex mb-4 justify-content-start">
                        <img src="http://localhost/message/img/grenouille.jpg" alt="avatar" width="10%" height="10%" class="rounded-circle mx-2">
                        <div class="card mask-custom w-50 bg-light borded-5 text-dark">
                            <div class="card-header d-flex justify-content-between p-3">
                                <p class="fw-bold mb-0">MAripitia</p>
                                <p class="small mb-0">
                                    <i class="fa fa-clock">                    
                                    </i>Il y a 5mn
                                </p>
                            </div>
                            <div class="card-body text-start">
                                <p class="mb-0">
                                    ${ addLineBreaks((value.MpMoi)) }
                                </p>
                            </div>
                        </div>
                    </li>
                `;  
            }

            $("#discussion").append(html);
            scrollMessageToBottom();
        });

    });
}


function createMessage(MpMoi, idPersonneCreate) {
    var date = moment(new Date()).format("YYYY-MM-DD hh:mm:ss");
    var create = {
        "url": "http://localhost/message/requetesPHP/curlCreateMessage.php",
        "method": "POST",
        "timeout": 0,
        "headers": {
          "Content-Type": "text/plain"
        },
        "dataType": "json",
        "data": JSON.stringify({
            "table": "messages",
            "Date": date,
            "MpMoi": MpMoi,
            "idPersonne": idPersonneCreate
        })
    }
    $.ajax(create).done(function (response) { 
        console.log(response);
    });

}


function removeMessage(idMessages) {
    var deleted = {
        "url": "http://localhost/message/requetesPHP/curlDeleteMessage.php",
        "method": "DELETE",
        "timeout": 0,
        "headers": {
          "Content-Type": "text/plain"
        },
        "dataType": "json",
        "data": JSON.stringify({
            "idMessages": idMessages,
        }),
      };
      
      $.ajax(deleted).done(function (response) {
        console.log(response);
      });

      $.ajax(deleted).fail(function (response) {
        // console.log(response);
      });
}


function updateMessage(id, MpMoiUpdate, idPersonneUpdate) {
    var date = moment(new Date()).format("YYYY-MM-DD hh:mm:ss");
    var settings = {
        "url": "http://localhost/message/requetesPHP/UpdateMessage.php",
        "method": "PUT",
        "timeout": 0,
        "headers": {
          "Content-Type": "text/plain"
        },
        "dataType": "json",
        "data": JSON.stringify({
            "table": "messages",
            "idMessages": id,
            "Date": date,
            "MpMoi": MpMoiUpdate,
            "idPersonne": idPersonneUpdate
        })
    };
      
    $.ajax(settings).done(function (response) {
        console.log(response);
    });
    $.ajax(settings).fail(function (response) {
        console.log(response);
    });
}


} 

function addLineBreaks(data) {
    return data.replace(/\n\r?/g, '<br>');
}
