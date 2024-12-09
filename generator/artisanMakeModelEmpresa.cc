#include <iostream>
#include <fstream>
#include <string>
#include <vector>
#include <sstream>
#include <stdexcept>
#include <regex>

using namespace std;

// Función para limpiar espacios en blanco
string trim(const string &str) {
    size_t first = str.find_first_not_of(" \t\n\r");
    if (first == string::npos) return "";
    size_t last = str.find_last_not_of(" \t\n\r");
    return str.substr(first, (last - first + 1));
}

// Función para extraer los atributos de la tabla en el SQL
vector<string> extractAttributes(const string &fileName) {
    ifstream inputFile(fileName);
    if (!inputFile.is_open()) {
        throw runtime_error("No se pudo abrir el archivo SQL de entrada.");
    }

    vector<string> attributes;
    string line;
    bool insideTableDefinition = false;

    while (getline(inputFile, line)) {
        line = trim(line);

        // Detectar el inicio y fin de la definición de la tabla
        if (line.find("CREATE TABLE") != string::npos) {
            insideTableDefinition = true;
            continue;
        }
        if (line.find(");") != string::npos) {
            insideTableDefinition = false;
            break;
        }

        // Si estamos dentro de la definición, extraer el nombre del campo
        if (insideTableDefinition && !line.empty() && line.find("PRIMARY KEY") == string::npos) {
            regex attributeRegex(R"(^\s*([a-zA-Z0-9_]+)\s+)");
            smatch match;
            if (regex_search(line, match, attributeRegex)) {
                attributes.push_back(match[1]);
            }
        }
    }

    inputFile.close();
    return attributes;
}

// Función para generar el modelo PHP con los métodos especificados
void generateModel(const vector<string> &attributes, const string &modelName, const string &outputFileName) {
    ofstream outputFile(outputFileName);
    if (!outputFile.is_open()) {
        throw runtime_error("No se pudo abrir el archivo de salida para escribir el modelo.");
    }

    string className = "modelo" + modelName;

    // Iniciar el archivo PHP
    outputFile << "<?php" << endl;
    outputFile << "require_once $_SERVER['DOCUMENT_ROOT'].'/models/connect/conexion.php';" << endl;
    outputFile << "" << endl;
    outputFile << "class " << className << " {" << endl;
    outputFile << "    private $conexion;" << endl;
    outputFile << "" << endl;
    outputFile << "    public function __construct() {" << endl;
    outputFile << "        $this->conexion = Conexion::obtenerconexion();" << endl;
    outputFile << "    }" << endl;
    outputFile << "" << endl;

    // Método listar
    outputFile << "    public function listar" << modelName << "s() {" << endl;
    outputFile << "        try {" << endl;
    outputFile << "            $query = $this->conexion->query(" << endl;
    outputFile << "                'SELECT " << endl;

    for (size_t i = 0; i < attributes.size(); ++i) {
        outputFile << "                    " << attributes[i];
        if (i < attributes.size() - 1) outputFile << ",";
        outputFile << endl;
    }
    outputFile << "                 FROM " << modelName << "'" << endl;
    outputFile << "            );" << endl;
    outputFile << "            return $query->fetchAll(PDO::FETCH_ASSOC);" << endl;
    outputFile << "        } catch (PDOException $e) {" << endl;
    outputFile << "            throw new Exception('Error al listar " << modelName << "s: ' . $e->getMessage());" << endl;
    outputFile << "        }" << endl;
    outputFile << "    }" << endl;
    outputFile << "" << endl;

    // Método obtenerPorId
    outputFile << "    public function obtener" << modelName << "PorId($id) {" << endl;
    outputFile << "        try {" << endl;
    outputFile << "            $query = $this->conexion->prepare(" << endl;
    outputFile << "                'SELECT " << endl;

    for (size_t i = 0; i < attributes.size(); ++i) {
        outputFile << "                    " << attributes[i];
        if (i < attributes.size() - 1) outputFile << ",";
        outputFile << endl;
    }
    outputFile << "                 FROM " << modelName << " WHERE " << attributes[0] << " = ?'" << endl;
    outputFile << "            );" << endl;
    outputFile << "            $query->execute([$id]);" << endl;
    outputFile << "            return $query->fetch(PDO::FETCH_ASSOC);" << endl;
    outputFile << "        } catch (PDOException $e) {" << endl;
    outputFile << "            throw new Exception('Error al obtener " << modelName << ": ' . $e->getMessage());" << endl;
    outputFile << "        }" << endl;
    outputFile << "    }" << endl;
    outputFile << "" << endl;

    // Método insertar
    outputFile << "    public function insertar" << modelName << "($datos) {" << endl;
    outputFile << "        try {" << endl;
    outputFile << "            $query = $this->conexion->prepare(" << endl;
    outputFile << "                'INSERT INTO " << modelName << " (" << endl;

    for (size_t i = 1; i < attributes.size(); ++i) { // Excluir el ID
        outputFile << "                    " << attributes[i];
        if (i < attributes.size() - 1) outputFile << ",";
        outputFile << endl;
    }

    outputFile << "                ) VALUES (" << endl;
    for (size_t i = 1; i < attributes.size(); ++i) {
        outputFile << "                    :" << attributes[i];
        if (i < attributes.size() - 1) outputFile << ",";
        outputFile << endl;
    }
    outputFile << "                )'" << endl;
    outputFile << "            );" << endl;

    for (size_t i = 1; i < attributes.size(); ++i) {
        outputFile << "            $query->bindParam(':" << attributes[i] << "', $datos['" << attributes[i] << "']);" << endl;
    }

    outputFile << "            return $query->execute();" << endl;
    outputFile << "        } catch (PDOException $e) {" << endl;
    outputFile << "            throw new Exception('Error al insertar " << modelName << ": ' . $e->getMessage());" << endl;
    outputFile << "        }" << endl;
    outputFile << "    }" << endl;
    outputFile << "" << endl;

    // Método modificar
    outputFile << "    public function modificar" << modelName << "($id, $datos) {" << endl;
    outputFile << "        try {" << endl;
    outputFile << "            $query = $this->conexion->prepare(" << endl;
    outputFile << "                'UPDATE " << modelName << " SET " << endl;

    for (size_t i = 1; i < attributes.size(); ++i) { // Excluir el ID
        outputFile << "                    " << attributes[i] << " = :" << attributes[i];
        if (i < attributes.size() - 1) outputFile << ",";
        outputFile << endl;
    }

    outputFile << "                WHERE " << attributes[0] << " = :id'" << endl;
    outputFile << "            );" << endl;

    for (size_t i = 1; i < attributes.size(); ++i) {
        outputFile << "            $query->bindParam(':" << attributes[i] << "', $datos['" << attributes[i] << "']);" << endl;
    }
    outputFile << "            $query->bindParam(':id', $id);" << endl;
    outputFile << "            return $query->execute();" << endl;
    outputFile << "        } catch (PDOException $e) {" << endl;
    outputFile << "            throw new Exception('Error al modificar " << modelName << ": ' . $e->getMessage());" << endl;
    outputFile << "        }" << endl;
    outputFile << "    }" << endl;
    outputFile << "" << endl;

    // Método eliminar
    outputFile << "    public function eliminar" << modelName << "($id) {" << endl;
    outputFile << "        try {" << endl;
    outputFile << "            $query = $this->conexion->prepare('DELETE FROM " << modelName << " WHERE " << attributes[0] << " = ?');" << endl;
    outputFile << "            $query->execute([$id]);" << endl;
    outputFile << "            return $query->rowCount() > 0;" << endl;
    outputFile << "        } catch (PDOException $e) {" << endl;
    outputFile << "            throw new Exception('Error al eliminar " << modelName << ": ' . $e->getMessage());" << endl;
    outputFile << "        }" << endl;
    outputFile << "    }" << endl;

    // Cerrar clase
    outputFile << "}" << endl;
    outputFile << "?>" << endl;

    outputFile.close();
    cout << "Modelo generado correctamente: " << outputFileName << endl;
}

// Función principal
int main(int argc, char *argv[]) {
    if (argc != 3) {
        cerr << "Uso: " << argv[0] << " <archivo_sql> <archivo_modelo_salida>" << endl;
        return 1;
    }

    string inputFileName = argv[1];
    string outputFileName = argv[2];

    try {
        string modelName = outputFileName.substr(0, outputFileName.find(".php"));
        vector<string> attributes = extractAttributes(inputFileName);
        generateModel(attributes, modelName, outputFileName);
    } catch (const exception &e) {
        cerr << "Error: " << e.what() << endl;
        return 1;
    }

    return 0;
}
