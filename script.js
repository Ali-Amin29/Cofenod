let username = document.getElementById("validationCustom01");
let email = document.getElementById('exampleInputEmail1');
let password = document.getElementById('exampleInputPassword0');
let confirmPassword = document.getElementById('exampleInputPassword1');
let floor = document.getElementById('validationCustom04');
let room = document.getElementById('validationCustom05');
// console.log('ali');
function UserAdd() {
    if (username.value == "") {
        email.setAttribute('value',"");
    }
    else{
        
        email.setAttribute('value',username.value+"@cafenod.net");
    }
}

username.oninput=(e)=>{
   
    if (username.value == "" || email.value == "" )
    {
        username.className="form-control";
        email.className="form-control";

    }
    else {
    
        if(e.target.value.match(/^[a-z_. A-Z]/) )
        {
            e.target.className="form-control is-valid"
            if(email.value.match(/^[a-z._A-Z0-9]+@+[a-z]+.+["com"|"net"]/))
            {
                email.className="form-control is-valid"
            }else{
                email.className="form-control is-invalid"
            }
           
        }
        else
        {
            e.target.className="form-control is-invalid"
            email.className="form-control is-invalid"
        }
       
    }

}
email.oninput=(e)=>{
    if (email.value == "")
    {
        email.className="form-control";
    }
    else {
        if(e.target.value.match(/^[a-z._A-Z0-9]+@+[a-z]+.+["com"|"net"]/) )
        {
            e.target.className="form-control is-valid"
            console.log(e.target.value);

        }
        else
        {
            e.target.className="form-control is-invalid"
        }
    }

}
password.oninput=(e)=>{
    if (password.value == "")
    {
        password.className="form-control"
    }
    else {
    if(e.target.value.match(/^[0-9a-zA-Z]{8,}/))
    {
        password.className="form-control is-valid"
    }
    else
    {
        password.className="form-control is-invalid"
    }
    }

}
confirmPassword.oninput=(e)=>{
   if (confirmPassword.value == "")
   {
       confirmPassword.className="form-control";
   }
   else{
    if(password.value==e.target.value)
    {
        confirmPassword.className="form-control is-valid"
    }
    else
    {
        confirmPassword.className="form-control is-invalid"
    }
    }
}
floor.oninput=(e)=>{
  
   for(var i=0; i<=floor.value; i++)
   {
        if (floor.value==i)
        {
            floor.className="form-control is-valid"
            console.log('ali');
            document.getElementById('FloorDetails').innerHTML = 'The Number Of Your Floor'+i;
            break;
        }
    }

}
room.oninput=(e)=>{
    if(room.value=="")
    {
        room.className="form-control is-invalid";
    }
    else
    {
        room.className="form-control is-valid"
        document.getElementById('RoomDetails').innerHTML = "Your Room Number is "+room.value;
    }
}
 formFile.oninput=(e)=>{
     if(formFile.value=='')
     {
        formFile.className="form-control is-invalid"
    }
    else{
        formFile.className="form-control is-valid"
    }
}