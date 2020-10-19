$(document).ready(function(){

});

$("#login").on("click",function(){
    let login = document.querySelector(".main-login");

    let obj = {

        name : $("#name").val(),
        password : $("#password").val(),
        opc : "get_account"
    }

    $.ajax({
        type : "POST",
        url : "exec.php",
        data: obj
    }).done(function(data){
        
        return new Promise((resolve,reject)=>{
            alert("sending...");
            setTimeout(()=>{
                resolve(
                console.log(data),
                alert("Done"),
               login.classList.toggle("hide"),
                $(".ammountHolder").append(data),
                $(".welcome").append(" " +obj.name),
                $(".ammountHolder,#retire,#deposit").toggleClass("show"));
            reject = new Error("Error","User not Found");
            },2000);
            if(obj.name == "" && obj.lastname == ""){
                   $(".welcome").next("p").remove();
                   $("#retire,#deposit").css("display","none");
            }
        });
    }).fail(function(data){
        console.log(data);
        alert("error");
    });

});

$(document).on("click","#makeRetirement",(e)=>{
    e.stopPropagation();
    let confirm = document.querySelector(".ammount_info");
    let convert = parseInt(confirm.innerText);
   if(convert <= 0){
       alert("Your account is in 0.00");
       return;
   }
    let ammountToRetire = prompt();
    console.log(ammountToRetire);
    let totalAmmount = parseInt($(".ammount_info").text())-ammountToRetire;
    let accountid = $(".ammount_info").data("accountid");

    function retireMoney(){

        let obj = {
            opc : "retire",
            money : totalAmmount,
            user_id :accountid

        }
        $.ajax({
            type : "POST",
            url : "exec.php",
            data: obj
        }).done(function(data){
            alert("sending...");
            return new Promise((resolve,reject)=>{
                setTimeout(()=>{
                    resolve(console.log(data),
                    alert("retirement success"),
                   $(".ammount_info").text(totalAmmount));
                },2000)
            });
        }).fail(function(data){
            console.log(data);
            alert("error");
        });
    
    }

    retireMoney();
});

$(document).on("click","#makeDeposit",function(){

    let ammountToDeposit = prompt();
    console.log(ammountToDeposit);
    let totalAmmount = parseInt($(".ammount_info").text()) + parseInt(ammountToDeposit);
    console.log(totalAmmount);
    let accountid = $(".ammount_info").data("accountid");

    function depositMoney(){
        let obj = {
            opc : "deposit",
            money : totalAmmount,
            userid : accountid
        }

        $.ajax({
            type : "POST",
            url : "exec.php",
            data: obj
        }).done(function(data){
                console.log(data);
                alert("Deposit success");
               $(".ammount_info").text(totalAmmount);
        }).fail(function(data){
            console.log(data);
            alert("error");
        });


    }
    depositMoney();

});

const logout = document.querySelector(".logout");
logout.addEventListener("click",(e)=>{
    window.location.reload();
});

$(".save-user").on("click",function(){

    let obj = {
        opc : "save_user",
        name : $("#userName").val(),
        lastname : $("#userLastname").val()
    }

     $.ajax({
            type : "POST",
            url : "exec.php",
            data: obj
        }).done(function(data){
                console.log(data);
                alert("Account created");
               window.location.reload();
        }).fail(function(data){
            console.log(data);
            alert("error");
        });

});