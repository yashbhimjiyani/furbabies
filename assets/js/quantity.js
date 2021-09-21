
function minusone(){
    if(document.getElementById("quantity").value<=1){
        document.getElementById("minus").disabled=true;
    }
    else{
        document.getElementById("minus").disabled=false;
        document.getElementById("quantity").value=parseInt(document.getElementById("quantity").value)-1;
    }
}
function plusone(){
    document.getElementById("minus").disabled=false;
    document.getElementById("quantity").value=parseInt(document.getElementById("quantity").value)+1;
}