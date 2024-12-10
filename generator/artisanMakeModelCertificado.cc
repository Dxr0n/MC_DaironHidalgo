#include <iostream>
#include <fstream>
#include <string>
#include <vector>
#include <sstream>
#include <stdexcept>

using namespace std;

// Left trim the given string ("  hello!  " --> "hello!  ")
string left_trim(string str)
{
    int numStartSpaces = 0;
    for (int i = 0; i < str.length(); i++)
    {
        if (!isspace(str[i]))
            break;
        numStartSpaces++;
    }
    return str.substr(numStartSpaces);
}

// Right trim the given string ("  hello!  " --> "  hello!")
string right_trim(string str)
{
    int numEndSpaces = 0;
    for (int i = str.length() - 1; i >= 0; i--)
    {
        if (!isspace(str[i]))
            break;
        numEndSpaces++;
    }
    return str.substr(0, str.length() - numEndSpaces);
}

// Left and right trim the given string ("  hello!  " --> "hello!")
string trim(string str)
{
    return right_trim(left_trim(str));
}

string split(const string &str, char delimiter, size_t position)
{
    vector<string> tokens;
    string token;
    istringstream tokenStream(str);

    // Dividir la cadena en tokens
    while (getline(tokenStream, token, delimiter))
    {
        tokens.push_back(token);
    }

    // Validar que la posición solicitada esté dentro de los límites
    if (position >= tokens.size())
    {
        throw out_of_range("La posición está fuera de los límites del split.");
    }

    return tokens[position];
}

void processFile(const string &inputFileName, const string &outputFileName)
{
    ifstream inputFileContador(inputFileName); // Archivo de entrada
    ofstream outputFile(outputFileName);       // Archivo de salida genero mi nuevo archivo

    if (!inputFileContador.is_open())
    {
        cerr << "No se pudo abrir el archivo de entrada: " << inputFileName << endl;
        return;
    }

    if (!outputFile.is_open())
    {
        cerr << "No se pudo abrir el archivo de salida: " << outputFileName << endl;
        return;
    }

    string linea;
    string nombreModelo; // registroVentas.php
    int longitud;
    int contador;
    int totallineas;

    nombreModelo = outputFileName;
    longitud = nombreModelo.length();
    nombreModelo = nombreModelo.substr(0, longitud - 4); // revisar

    cout << longitud << endl;
    cout << nombreModelo << endl;

    outputFile << "<?php" << endl;
    outputFile << "require_once $_SERVER['DOCUMENT_ROOT'] . '/models/connect/conexion.php';" << endl;
    outputFile << "" << endl;
    outputFile << "// TODO LO RELACIONADO A LA BASE DE DATOS, DEBE DE ESTAR EN EL MODELO" << endl;
    outputFile << "// UN MODELO POR LO REGULAR APUNTA A UNA TABLA O UNA VISTA" << endl;
    outputFile << "class modelo" + nombreModelo << endl;
    outputFile << "{" << endl;
    outputFile << "" << endl;
    outputFile << "    private $conexion;" << endl;
    outputFile << "" << endl;
    outputFile << "    // al instanciar la clase debo obtener la conexion " << endl;
    outputFile << "    public function __construct()" << endl;
    outputFile << "    {" << endl;
    outputFile << "        $this->conexion = Conexion::obtenerConexion();" << endl;
    outputFile << "    }" << endl;
    outputFile << "" << endl;
    outputFile << "    // debe hacer un metodo para hacer select" << endl;

    //!Obtener

    outputFile << "    public function obtener" + nombreModelo + "()" << endl;
    outputFile << "    {" << endl;
    outputFile << "        $query = $this->conexion->query('select '." << endl;

    totallineas = 0;
    while (getline(inputFileContador, linea))
    {
        totallineas++;
    }

    ifstream inputFile(inputFileName);
    string campos[150];
    contador = 0;

    // Leer las líneas y almacenar los campos
    while (getline(inputFile, linea))
    {
        contador++;
        if ((contador > 2) && (contador < totallineas - 1))
        {
            string lineaCodigo = linea;
            lineaCodigo = trim(lineaCodigo);
            lineaCodigo = split(lineaCodigo, ' ', 0);
            campos[contador] = lineaCodigo;
        }
    }
    
    // Generar el código con manejo de la última coma
    for (int i = 3; i < contador; i++) // Ajuste del índice para ignorar cabeceras
    {
        string lineaCodigo;
        if (i == contador - 2) // penutimo campo, sin coma
        {
            lineaCodigo = "'" + campos[i] + "'.";
        } else if ( i == contador - 1)
        {
            break;
        }
        
        else // Campos intermedios, con coma
        {
            lineaCodigo = "'" + campos[i] + ",'.";
        } 
        
        outputFile << lineaCodigo << endl;
    }

    outputFile << "'from " + nombreModelo + "');" << endl;
    outputFile << "        return $query->fetchAll(PDO::FETCH_ASSOC);" << endl;
    outputFile << "    }" << endl;
    outputFile << "    " << endl;

    //!INSERTAR

    outputFile << "    // debe hacer un metodo para hacer insert" << endl;
    outputFile << "    public function insertar" + nombreModelo + "(" << endl;

    for (int i = 3; i < contador - 1; i++)
    {
        if (i == contador - 2) // penutimo campo, sin coma
        {
        outputFile << "    $" + campos[i] + "" << endl;
        } else if ( i == contador - 1)
        {
            break;
        }
        
        else // Campos intermedios, con coma
        {
        outputFile << "    $" + campos[i] + "," << endl;
        } 
    }

    outputFile << "    )" << endl;
    outputFile << "    {" << endl;
    outputFile << "        $query = 'INSERT INTO " << nombreModelo << " ('." << endl;
    for (int i = 3; i < contador - 1; i++)
    {
        
        if (i == contador - 2) // penutimo campo, sin coma
        {
        outputFile << "                '" + campos[i] + "'." << endl;
        } else if ( i == contador - 1)
        {
            break;
        }
        else // Campos intermedios, con coma
        {
        outputFile << "                '" + campos[i] + ",'." << endl;
        } 
    }
    outputFile << "                 ') VALUES( '." << endl;

    for (int i = 3; i < contador - 1; i++)
    {
        if (i == contador - 2) // penutimo campo, sin coma
        {
        outputFile << "                ':" + campos[i] + "'." << endl;
        } else if ( i == contador - 1)
        {
            break;
        }
        else // Campos intermedios, con coma
        {
        outputFile << "                ':" + campos[i] + ",'." << endl;
        } 
    }

    outputFile << "                  ') ';" << endl;

    outputFile << "        //statement o sentencia" << endl;
    outputFile << "        //HOLA!" << endl;
    outputFile << "        $stmt = $this->conexion->prepare($query);" << endl;

    for (int i = 3; i < contador - 1; i++)
    {
        outputFile << "        $stmt->bindParam(':" << campos[i] << "', $" << campos[i] << ");" << endl;
    }

    outputFile << "        return $stmt->execute();" << endl;
    outputFile << "    }" << endl;


    //?ObtenerUsuarioPorNombre (No existe ID en la tabla) (JUAN)

    outputFile << "    public function obtenerNombre" << nombreModelo << "($" << "NOMBRE" << ")" << endl;
    outputFile << "    {" << endl;
    outputFile << "        try {" << endl;
    outputFile << "            $query = $this->conexion->prepare('SELECT ";
    for (int i = 3; i < contador - 1; i++)
    {//!
        if (i == contador - 2) // penutimo campo, sin coma
        {
        outputFile << "" + campos[i] + "";
        } else if ( i == contador - 1)
        {
            break;
        }
        
        else // Campos intermedios, con coma
        {
        outputFile << "" + campos[i] + ", ";
        }
    }
    outputFile << " FROM " << nombreModelo << " WHERE " << campos[3] << " = ?');" << endl;
    outputFile << "            $query->execute([$" << campos[3] << "]);" << endl;
    outputFile << "            return $query->fetch(PDO::FETCH_ASSOC);" << endl;
    outputFile << "        } catch (PDOException $e) {" << endl;
    outputFile << "            throw new Exception('Error al obtener " << nombreModelo << ": ' . $e->getMessage());" << endl;
    outputFile << "        }" << endl;
    outputFile << "    }" << endl;

    //?

    //! MODIFICAR (JUAN)

    outputFile << "    public function modificar" << nombreModelo << "(";
    for (int i = 3; i < contador - 1; i++)
    { // Iterar desde el segundo campo
        if (i == contador - 2) // penutimo campo, sin coma
        {
        outputFile << "$" + campos[i] + "";
        } else if ( i == contador - 1)
        {
            break;
        }
        
        else // Campos intermedios, con coma
        {
        outputFile << "$" + campos[i] + ", ";
        }
    }
    outputFile << ")" << endl;
    outputFile << "    {" << endl;
    outputFile << "        try {" << endl;
    outputFile << "            $query = $this->conexion->prepare('UPDATE " << nombreModelo << " SET ";

    for (int i = 3; i < contador - 1; i++)
    {
        outputFile << campos[i] << " = ?";
        if (i < contador - 2)
        { 
            outputFile << ", ";
        }
    }
    outputFile << " WHERE " << campos[3] << " = ?');" << endl; 

    outputFile << "            $query->execute([";
    for (int i = 3; i < contador - 1; i++)
    {
        if (i == contador - 1) // penutimo campo, sin coma
        {
            break;
        } else if ( i == contador - 2)
        {
            outputFile << "$" + campos[i] + "";
        }
        else // Campos intermedios, con coma
        {
        outputFile << "$" + campos[i] + ", ";
        }
    }
    outputFile <<"]);" << endl;

    outputFile << "            return $query->rowCount() > 0;" << endl;
    outputFile << "        } catch (PDOException $e) {" << endl;
    outputFile << "            throw new Exception('Error al actualizar " << nombreModelo << ": ' . $e->getMessage());" << endl;
    outputFile << "        }" << endl;
    outputFile << "    }" << endl;

    //?

    //! LISTAR (ALAN)

    outputFile << "    public function listar" + nombreModelo + "()" << endl;
    outputFile << "    {" << endl;
    outputFile << "        try {" << endl;
    outputFile << "            $query = $this->conexion->query('SELECT ";
    for (size_t i = 3; i < contador - 1; i++)
    {
        outputFile << campos[i];
        if (i < contador - 1)
        {
            outputFile << ", ";
        }
    }
    outputFile << " FROM " << nombreModelo << "');" << endl;
    outputFile << "            return $query->fetchAll(PDO::FETCH_ASSOC);" << endl;
    outputFile << "        } catch (PDOException $e) {" << endl;
    outputFile << "            throw new Exception('Error al listar usuarios: ' . $e->getMessage());" << endl;
    outputFile << "        }" << endl;
    outputFile << "    }" << endl;

    //?

    //! Validar (ALAN)

    outputFile << "    public function validar" + nombreModelo + "(";
    for (int i = 3; i < contador - 1; i++)
    { // Iterar desde el segundo campo
        if (i == contador - 2) // penutimo campo, sin coma
        {
        outputFile << "$" + campos[i] + "";
        } else if ( i == contador - 1)
        {
            break;
        }
        
        else // Campos intermedios, con coma
        {
        outputFile << "$" + campos[i] + ", ";
        }
    }
    outputFile << ")" << endl;

    outputFile << "    {" << endl;
    outputFile << "        try {" << endl;
    outputFile << "            $query = $this->conexion->prepare('SELECT ";
    for (size_t i = 3; i < contador - 1; i++)
    {
        outputFile << campos[i];
        if (i < contador - 1)
        {
            outputFile << ", ";
        }
    }
    outputFile << " FROM " << nombreModelo << " WHERE username = ? AND password = ?');" << endl;
    outputFile << "            $query->execute([";
    for (int i = 3; i < contador - 1; i++)
    {
        if (i == contador - 1) // penutimo campo, sin coma
        {
            break;
        } else if ( i == contador - 2)
        {
            outputFile << "$" + campos[i] + "";
        }
        else // Campos intermedios, con coma
        {
        outputFile << "$" + campos[i] + ", ";
        }
    }
    outputFile <<"]);" << endl;
    outputFile << "            return $query->fetch(PDO::FETCH_ASSOC);" << endl;
    outputFile << "        } catch (PDOException $e) {" << endl;
    outputFile << "            throw new Exception('Error al validar usuario: ' . $e->getMessage());" << endl;
    outputFile << "        }" << endl;
    outputFile << "    }" << endl;

    //?

    outputFile << " }" << endl;
    cout << "Modelo Generado. Archivo generado: " << outputFileName << endl;

    inputFile.close();
    outputFile.close();
}

int main(int argc, char *argv[])
{
    if (argc != 3)
    {
        cerr << "Uso del comando ArtisanMakeModel: " << argv[0] << " <archivo_entrada> <archivo_salida>" << endl;
        return 1;
    }

    string inputFileName = argv[1];
    string outputFileName = argv[2];

    processFile(inputFileName, outputFileName);

    return 0;
}

