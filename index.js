
console.log(location.href);
const bleep = new Audio();
bleep.src = "orb.mp3";
const bleep2 = new Audio();
bleep2.src = "bow_shoot.mp3";
const bleep3 = new Audio();
bleep3.src = "classic_hurt.mp3";
const bleep4 = new Audio();
bleep4.src = "sheep.mp3";
const bleep5 = new Audio();
bleep5.src = "click.mp3";
const bleep6 = new Audio();
bleep6.src = "drink.mp3";

if (!location.href.includes("key=1")) {

    const getvalue = document.getElementsByName('options')[0];
    getvalue.addEventListener('input', function () {
        
        const opcion = this.value;
        sessionStorage.setItem('res', opcion);
        console.log(opcion);
        bleep5.play();
        
    });

    const lol = document.getElementsByName('options1')[0];
    lol.addEventListener('input', function() {
        const op = this.value;
        console.log(op);
        bleep5.play();
    });






    
}
if (location.href.includes("key=1")) {
    const respuesta = sessionStorage.getItem('res');
    const headd = document.getElementById("opcionxd");
    const ttitulo = document.getElementById("titulo");
    const btns = document.getElementById("btns");
    const texto = document.getElementById("texto");
    const list = document.getElementById("l1");
    const formulario = document.getElementById("formulario");
    const invi = document.getElementById("invi");
    const img = document.getElementById("imgxd");
    const imgsangre = document.getElementById("imgsangre1");
    let arr8=[""];let arr7 = [""]; let arr6 = [""]; let arr5 = [""]; let arr4 = [""]; let arr3 = [""]; let arr2 = [""]; let arr1 = [""];

    //Lista de jugadores con la espada más fuerte
    if (respuesta == "1") {
        headd.innerHTML = "Lista de jugadores con la espada mas fuerte:";
        const consulta = "SELECT xd.Player,w.ID_Weapon,w.damage FROM equip AS xd INNER JOIN weapon AS w ON xd.id_weapon=w.ID_weapon where damage=(select max(damage) from weapon);";
        invi.innerHTML = "<select name='question'>" + " <option selected>" + consulta + "</option></select>";
        formulario.addEventListener('submit', function (e) {
            e.preventDefault();
            var datos = new FormData(this);
            fetch('posttabla.php', {
                method: 'POST',
                body: datos
            })
                .then(res => res.text())
                .then(data => {
                    console.log(data);
                    arr1 = data.split("\"");
                    let auxtext = "";
                    let cont = 1;
                    ttitulo.innerHTML = "<center><h3 class='cafe'>" + "TABLA" + "</h3></center>";
                    if(arr1.length==1){
                        texto.innerHTML="<center></center><h5>No hay jugadores que tengan la espada mas fuerte del juego</h5></center>";
                    }
                    auxtext = "<table class='table table table-bordered'><thead class='table-dark'>";
                    let cont2 = 1;
                    
                    for (let i = 0; i < arr1.length; i++) {
                        if (i % 2 != 0) {
                            if (cont <= 3) {
                                auxtext = auxtext + "<td>" + arr1[i] + "</td>";
                                if (cont == 3) {
                                    auxtext = auxtext + "</tr></thead><tbody><tr>";
                                }
                            }

                            else {

                                if (cont2 == 1) {
                                    auxtext = auxtext + "<td>" + arr1[i] + "</td>";
                                }
                                else {
                                    auxtext = auxtext + "<td>" + arr1[i] + "</td>";
                                }
                                if (cont % 3 == 0) {
                                    auxtext = auxtext + "</tr><tr>";

                                }
                                if (cont2 == 3) {
                                    cont2 = 0;
                                }
                                console.log("cont " + cont + " cont2 " + cont2 + " " + i);
                                cont2 = cont2 + 1;
                            }

                            cont = cont + 1;
                        }

                    }
                    auxtext = auxtext + "</tr></tbody></table>";
                    
                    list.innerHTML = auxtext;

                })


        })




    }

    //Jugador que más NPCs hostiles y Jefes mato
    if (respuesta == "2") {
        headd.innerHTML = "El jugador que mas NPCs hostiles y jefes mato es "

        btns.innerHTML =
            "<button onmousedown='bleep5.play()' class='btn flex' onclick='f()'>Fuerza</button>" +
            "<button onmousedown='bleep5.play()' class='btn flex' onclick='f1()'>Armadura</button>" +
            "<button onmousedown='bleep5.play()' class='btn flex' onclick='f2()'>NPCs</button>";

        function f() {
            texto.innerHTML = "<br><h5>El valor de fuerza es de: " + arr2[3] + "</h5>"
        }
        function f1() {
            texto.innerHTML = "<br><h5>La armadura del jugador es de: " + arr2[5] + "</h5>"
        }
        function f2() {
            texto.innerHTML = "<br><h5>Los NPCs asesinados por este jugador son: " + arr2[7] + "</h5>"
        }

        const consulta = "select Player,players.Damage,players.Armor,count(*) AS veces FROM kills INNER JOIN npc ON Npc=Name INNER JOIN players ON Player=players.Name WHERE type!='Pacifico' GROUP BY players.Name ORDER BY count(*) DESC limit 1";
        invi.innerHTML = "<select name='question'>" + " <option selected>" + consulta + "</option></select>";
        formulario.addEventListener('submit', function (e) {
            e.preventDefault();
            var datos = new FormData(this);
            fetch('posttexto.php', {
                method: 'POST',
                body: datos
            })
                .then(res => res.text())
                .then(data => {
                    console.log(data)
                    arr2 = data.split("\"")
                    const jefe = arr2[1];
                    ttitulo.innerHTML = "<center><h3>" + jefe + "</h3></center>";
                })

        })

    }

    //Jefe mas fuerte.(suma entre vida, daño y armadura)
    if (respuesta == "3") {
        headd.innerHTML = "El jefe mas fuerte existente en el juego es"

        btns.innerHTML =
            "<button onmousedown='bleep5.play()' class='btn flex' onclick='f()'>Daño</button>" +
            "<button onmousedown='bleep5.play()' class='btn flex' onclick='f1()'>Armadura</button>" +
            "<button onmousedown='bleep5.play()' class='btn flex' onclick='f2()'>Vida</button>";



        function f() {
            texto.innerHTML = "<br><h5>Fuerza de este Jefe: " + arr3[3] + "</h5>"
        }
        function f1() {
            texto.innerHTML = "<br><h5>Armadura de este Jefe: " + arr3[5] + "</h5>"
        }
        function f2() {
            texto.innerHTML = "<br><h5>Vida de este Jefe: " + arr3[7] + "</h5>"
        }
        const consulta = "select Name,Damage,Armor,Health AS " +
            "Fuerza FROM npc WHERE (Health+Damage+Armor) " +
            "IN (SELECT max(Health+Damage+Armor) FROM npc) and Type='Jefe';";
        invi.innerHTML = "<select name='question'>" + " <option selected>" + consulta + "</option></select>";
        formulario.addEventListener('submit', function (e) {
            e.preventDefault();
            var datos = new FormData(this);
            fetch('posttexto.php', {
                method: 'POST',
                body: datos
            })
                .then(res => res.text())
                .then(data => {
                    console.log(data)
                    arr3 = data.split("\"")
                    const jefe = arr3[1];
                    ttitulo.innerHTML = "<center><h3>" + jefe + "</h3></center>";
                })

        })

    }

    //Promedio nivel de los jugadores
    if (respuesta == "4") {
        headd.innerHTML = "Este es el promedio de nivel de todos los jugadores"
        const promedio = "";
        const consulta = "select avg(Level) from players;";
        invi.innerHTML = "<select name='question'>" + " <option selected>" + consulta + "</option></select>";
        formulario.addEventListener('submit', function (e) {
            e.preventDefault();
            var datos = new FormData(this);
            fetch('posttexto.php', {
                method: 'POST',
                body: datos
            })
                .then(res => res.text())
                .then(data => {
                    console.log(data)
                    arr4 = data.split("\"")
                    const promedio = arr4[1];
                    ttitulo.innerHTML = "<center><h3>" + promedio + "</h3></center>";
                })

        })
        texto.innerHTML = "<h3>" + promedio + "</h3>";
    }

    //Pocion mas utilizada
    if (respuesta == "5") {

        headd.innerHTML = "La pocion que mas ha sido utilizada es"
        const pocion = "";
        const consulta = "select Potions,count(*) from drink group by Potions order by count(*) desc limit 1;";
        invi.innerHTML = "<select name='question'>" + " <option selected>" + consulta + "</option></select>";
        formulario.addEventListener('submit', function (e) {
            e.preventDefault();
            var datos = new FormData(this);
            fetch('posttexto.php', {
                method: 'POST',
                body: datos
            })
                .then(res => res.text())
                .then(data => {
                    console.log(data)
                    arr5 = data.split("\"")
                    const pocion = arr5[1];
                    ttitulo.innerHTML = "<h3 class='tcenter'>" + pocion + "</h3>";
                    texto.innerHTML = "<h4>Ha sido bebido " + arr5[3] + " veces</h4>";
                    img.innerHTML = "<img class='imgtiny' onmousedown='bleep6.play()' src='https://vignette.wikia.nocookie.net/minecraftstorymode/images/4/47/Poci%C3%B3n_de_velocidad.png/revision/latest/scale-to-width-down/340?cb=20160520172348&path-prefix=es' alt=''>";
                })

        })


    }

    //Bloque mas guardado por los jugadores
    if (respuesta == "6") {
        headd.innerHTML = "El bloque que ha sido guardado mas veces es"
        const bloque = "";

        const consulta = "select bloque,count(*) from save group by bloque order by count(*) desc limit 1;";
        invi.innerHTML = "<select name='question'>" + " <option selected>" + consulta + "</option></select>";
        formulario.addEventListener('submit', function (e) {
            e.preventDefault();
            var datos = new FormData(this);
            fetch('posttexto.php', {
                method: 'POST',
                body: datos
            })
                .then(res => res.text())
                .then(data => {
                    console.log(data)
                    arr6 = data.split("\"")
                    const bloque = arr6[1];
                    ttitulo.innerHTML = "<h3 class='tcenter'>Bloque de " + bloque + "</h3>";
                    texto.innerHTML = "<h5 class='tcenter'>Guardado " + arr6[3] + " veces</h5>";
                    img.innerHTML = "<img class='imgtiny' src='VSImgs/bloques.png' alt=''>";
                })

        })




    }

    //Cantidad de NPC asesinados por un jugador
    if (respuesta == "7") {
        let listajugadores = [""];
        const datos = new FormData(formulario);
        let jugador = "";

        formulario.addEventListener('submit', function (e) {
            e.preventDefault();
            var datos = new FormData(this);

            fetch('postarray.php', {
                method: 'POST',
                body: datos
            })
                .then(res => res.text())
                .then(data => {

                    console.log(data);
                    let valores = [""];
                    let a = 0;
                    let cont = 0;
                    let cont2 = 0;
                    let texto_aux = "";
                    listajugadores = (data.split("\""));
                    listajugadores.forEach(element => {


                        if (a == 0) {
                            texto_aux = texto_aux + "<br><select onmousedown='bleep5.play()' name='options' id='selectedn' class='form-control color1'>"
                                + "<option selected disabled=''>Seleccione un nombre</option>";
                        }
                        else {
                            if (a % 2 != 0) {

                                if (cont == 0) {
                                    cont2++;
                                    texto_aux = texto_aux + "<option value='" + cont2 + "'>" + element + "</option>";
                                }
                                if (cont == 1) {
                                    valores.push(element);
                                    console.log(valores);
                                }

                                cont++;
                                if (cont == 2) cont = 0;
                            }
                        }
                        a = a + 1;
                    })
                    texto_aux = texto_aux + "</select>";
                    ttitulo.innerHTML = texto_aux;
                    let opcion = "0";
                    const getvalue = document.getElementsByName('options')[0];
                    getvalue.addEventListener('input', function () {
                        opcion = this.value;
                        jugador = opcion;
                        bleep5.play();
                        imgsangre.innerHTML = "<center><h1 id='imgsangre' onmousedown='bleep3.play()'>Ha matado <br>" + valores[opcion] + "<br> NPCs </h1></center>";
                    
                    });
                })
            fetch('posttexto.php', {
                method: 'POST',
                body: datos
            })
        })
        headd.innerHTML = "Consulte el nombre del jugador";
        console.log(listajugadores)
    }

    //Promedio de daño y armadura de los jugadores con equipamiento
    if (respuesta == "8") {

        headd.innerHTML = "Promedio de daño y armadura de todos los jugadores con equipamiento";
        let promedioD = "";
        let promedioA = "";
        const consulta = "select avg(players.Armor+armadura.Armor) as "+ 
        "promedio_armadura,avg(players.Damage+weapon.damage) as " +
        "promedio_daño from players inner join equip on " +
        "players.Name=equip.Player inner join armadura on " +
        "equip.id_armor=armadura.ID_armor inner join "  +
        "weapon on equip.id_weapon=weapon.ID_weapon;";
        invi.innerHTML = "<select name='question'>" + " <option selected>" + consulta + "</option></select>";
        formulario.addEventListener('submit', function (e) {
            e.preventDefault();
            var datos = new FormData(this);
            fetch('posttexto.php', {
                method: 'POST',
                body: datos
            })
                .then(res => res.text())
                .then(data => {
                    console.log(data)
                    arr8 = data.split("\"")
                    promedioD = arr8[1];
                    promedioA = arr8[3]
                    ttitulo.innerHTML = "<center><h4> Promedio de daño: " + promedioD + "</h4></center>"+
                    "<center><h4> Promedio de armadura: "+promedioA+"</h4></center>";
                })

        })









    }
}
