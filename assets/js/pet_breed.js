function setPet(){
    
    var a=document.getElementById("category").value
    var array=[]
    switch (a) {
        case "Dog":
            array=["Beagle","Spitz","chug","Shephard","Golden","labrador","maltese","poo","pug","puli"]
            break;
        case "Cat":
            array=["American Short Hair","British Short hair","bengal","berman","Indian gray black","Ginger","himalayan","bobtail","munchkin","persian","pixiebob","ragdoll","scottish fold","toyger","turkish","asian","napolean"]
            break;
        case "Rabbit":
            array=["Rabbit"]
            break;
        case "Birds":
            array=["dove","Zebra finches","Hyacinth Macaw","Pineapple Conures","Cockatiels","Parrotlet","Budgies","Hahn’s Macaw","Love Birds","Sparrows"]
            break;
        case "Aquarium Pets":
            array=["Fish"]
            break;
        case "Squirrel":
            array=["Squirrel"]
            break;
        case "Tortoise":
            array=["Egyptian","Indian Star","sulcata","Russian","Hermanns"]
            break;
        case "Turtle":
            array=["Indian eyed","Indian pond","Indian softshell","Indian roofed","Indian flapshell"]
            break;
        case "Cattles":
            array=["Cows","Buffaloes","Goats","Sheeps","Camels","pigs"]
            break;
        case "Poultry":
            array=["Chickens","geese","Ducks"]
            break;
        case "Horse":
            array=["Horse"]
            break;
    }
    var string="<select><option value='Select Pet Breed' disabled selected>Select Pet Breed</option>"
    for (var i=0;i<array.length;i++) {
        string=string+"<option>"+array[i]+"</option>"
    }
    string=string+"</select>"
    document.getElementById("breed").innerHTML=string
    var b=document.getElementById("category").value
    var colors=[]
    switch (a) {
        case "Dog":
            colors=["Not Specific","White","Black","Golden","Gray","Black-white","Brown-white","Wheat","Brown"]
            break;
        case "Cat":
            colors=["Not Specific","White","Black","Orange","Brown","Gray","Gray-black","Golden-white","Black-White","Wheat"]
            break;
        case "Rabbit":
            colors=["White","Brown-White","Brown","Gray","Gray-white","Black-white"]
            break;
        case "Birds":
            colors=["Not Required"]
            break;
        case "Aquarium Pets":
            colors=["Not Required"]
            break;
        case "Squirrel":
            colors=["Not Required"]
            break;
        case "Tortoise":
            colors=["Not Required"]
            break;
        case "Turtle":
            colors=["Not Required"]
            break;
        case "Cattles":
            colors=["Not Required"]
            break;
        case "Poultry":
            colors=["Not Required"]
            break;
        case "Horse":
            colors=["White","Black","Brown","Golden","Black-white","Brown-white"]
            break;
    }
    var colorstring="<select><option value='Select Pet Color' disabled selected>Select Pet Color</option>"
    for (var i=0;i<colors.length;i++) {
        colorstring=colorstring+"<option>"+colors[i]+"</option>"
    }
    colorstring=colorstring+"</select>"
    document.getElementById("color").innerHTML=colorstring
}