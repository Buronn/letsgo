for i in range(100):
    a = "var btnAbrirPopup"+str(i)+" = document.getElementById('btn-abrir-popup"+str(i)+"'),\n\
	overlay"+str(i)+" = document.getElementById('overlay"+str(i)+"'),\n\
	popup"+str(i)+" = document.getElementById('popup"+str(i)+"'),\n\
	btnCerrarPopup"+str(i)+" = document.getElementById('btn-cerrar-popup"+str(i)+"');\n\
    \n\
    btnAbrirPopup"+str(i)+".addEventListener('click', function(){\n\
	overlay"+str(i)+".classList.add('active');\n\
	popup"+str(i)+".classList.add('active');\n\
    });\n\
        \n\
    btnCerrarPopup"+str(i)+".addEventListener('click', function(e){\n\
	e.preventDefault();\n\
	overlay"+str(i)+".classList.remove('active');\n\
	popup"+str(i)+".classList.remove('active');\n\
    });"
    print(a)
wait = input()


