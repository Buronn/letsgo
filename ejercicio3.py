import csv
#LOS NUMEROS NEGATIVOS SE TOMARON POR 0
with open('full_data.csv', encoding='utf8') as archivo:
    datos = csv.reader(archivo)
    i = 0
    last_country = "-1"
    total_casos = 0
    total_muertes = 0
    dias = 0
    paises = []
    for linea in datos:
        if (linea[1] != "location" and linea[1] != "World"):
            if (linea[1] != last_country and last_country != "-1"):
                i = i+1
                promedio_casos = int(total_casos/dias)
                promedio_muertes = int(total_muertes/dias)
                paises.append([last_country,promedio_casos,promedio_muertes])
                


                total_casos = 0
                total_muertes = 0
                dias = 0
            if(linea[2] != "" and "-" not in linea[2]):
                a = linea[2].split(".")
                a = int(a[0])
            else:
                a = 0
            if(linea[3] != "" and "-" not in linea[3]):
                b = linea[3].split(".")
                b = int(b[0])
            else:
                b = 0
            dias = dias + 1
            total_casos = total_casos + a
            total_muertes = total_muertes + b
            last_country = linea[1]

lista_contagios = []
lista_muertes = []

for i in paises:
    lista_contagios.append([i[1],i[0]])
    lista_muertes.append([i[2],i[0]])

lista_contagios.sort()
lista_contagios.reverse()

lista_muertes.sort()
lista_muertes.reverse()

myFile = open('muertes.csv', 'w')
with myFile:
    writer = csv.writer(myFile)
    for i in range (len(lista_muertes)):
        lista_muertes[i][0],lista_muertes[i][1] = lista_muertes[i][1],lista_muertes[i][0]
    writer.writerows(lista_muertes)

myFile = open('contagios.csv', 'w')
with myFile:
    writer = csv.writer(myFile)
    for i in range (len(lista_contagios)):
        lista_contagios[i][0],lista_contagios[i][1] = lista_contagios[i][1],lista_contagios[i][0]
    writer.writerows(lista_contagios)

wait = input()