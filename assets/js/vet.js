function setState(){
    var a=document.getElementById("set_state").value
    var array=[]
    switch (a) {
        case "Gujarat":
            array=["Rajkot","Surat","Junagudh","Ahmedabad","Vadodara","Jamnagar","Bhavnagar","Kutchh","Gandhinagar","Sasan","Veraval","Valsad"]
            break;
        case "Maharashtra":
            array=["Mumbai","Pune","Vashi","Navi Mumbai","Nagpur","Kohlapur","Ratnagiri","Thane"]
            break;
        case "Rajshthan":
            array=["Jaipur","Ajmer","Jodhpur","Udaipur","Jaisalmer","Abu"]
            break;
        case "Delhi":
            array=["North Delhi","New Delhi","East Delhi","South Delhi","Central Delhi","West Delhi"]
            break;
        case "Uttar Pradesh":
            array=["Lucknow","Kanpur","Agra","Meerut","Bareili","Prayagraj","Varanasi"]
            break;
        case "Goa":
            array=["Panji"]
            break;
        case "Diu, Daman & Dadra Nagar":
            array=["Diu","Daman","Dadra nagar haveli"]
            break;
        case "Karnataka":
            array=["Banglore Urban","Banglore rural","Mysore","Belagavi"]
            break;
        case "Punjab":
            array=["Amritsar","Bhatinda","Jalandhar","Ludhiana","Pathankot","Firozpur"]
            break;
        case "J & K":
            array=["Jammu","Srinagar","Gulmarg","Baramula","Pulwama","Anantnag","Poonch","Rajauri"]
            break;
    }
    var string="<select><option value='Select District/City' disabled selected>Select District/City</option>"
    for (var i=0;i<array.length;i++) {
        string=string+"<option>"+array[i]+"</option>"
    }
    string=string+"</select>"
    document.getElementById("set_city").innerHTML=string
}