#include <iostream>
#include <fstream>
#include <vector>
#include <string>
#include <stdexcept>
#include <sstream>
#include <regex>

using namespace std;

// Función para limpiar espacios en blanco
string trim(const string &str) {
    size_t first = str.find_first_not_of(" \t\n\r");
    if (first == string::npos) return "";
    size_t last = str.find_last_not_of(" \t\n\r");
    return str.substr(first, (last - first + 1));
}

// Atributos específicos de la tabla CONFIGURACION
vector<string> getConfiguracionAttributes() {
    return {"PARAMETRO", "VALOR", "CATEGORIA"};
}

// Función para generar el modelo PHP con los métodos especificados
void generateConfiguracionModel(const string &outputFileName) {
    ofstream outputFile(outputFileName);
    if (!outputFile.is_open()) {
        throw runtime_error("No se pudo abrir el archivo de salida para escribir el modelo.");
    }

    string modelName = "ConfiguracionEmpresa";
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

    vector<string> attributes = getConfiguracionAttributes();

    // Método listar
    outputFile << "    public function listar" << modelName << "() {" << endl;
    outputFile << "        try {" << endl;
    outputFile << "            $query = $this->conexion->query(" << endl;
    outputFile << "                'SELECT " << endl;

    for (size_t i = 0; i < attributes.size(); ++i) {
        outputFile << "                    " << attributes[i];
        if (i < attributes.size() - 1) outputFile << ",";
        outputFile << endl;
    }
    outputFile << "                 FROM CONFIGURACION'" << endl;
    outputFile << "            );" << endl;
    outputFile << "            return $query->fetchAll(PDO::FETCH_ASSOC);" << endl;
    outputFile << "        } catch (PDOException $e) {" << endl;
    outputFile << "            throw new Exception('Error al listar configuraciones: ' . $e->getMessage());" << endl;
    outputFile << "        }" << endl;
    outputFile << "    }" << endl;
    outputFile << "" << endl;

    // Método insertar
    outputFile << "    public function insertar" << modelName << "($datos) {" << endl;
    outputFile << "        try {" << endl;
    outputFile << "            $query = $this->conexion->prepare(" << endl;
    outputFile << "                'INSERT INTO CONFIGURACION (" << endl;

    for (size_t i = 0; i < attributes.size(); ++i) {
        outputFile << "                    " << attributes[i];
        if (i < attributes.size() - 1) outputFile << ",";
        outputFile << endl;
    }

    outputFile << "                ) VALUES (" << endl;
    for (size_t i = 0; i < attributes.size(); ++i) {
        outputFile << "                    :" << attributes[i];
        if (i < attributes.size() - 1) outputFile << ",";
        outputFile << endl;
    }
    outputFile << "                )'" << endl;
    outputFile << "            );" << endl;

    for (const auto &attribute : attributes) {
        outputFile << "            $query->bindParam(':" << attribute << "', $datos['" << attribute << "']);" << endl;
    }

    outputFile << "            return $query->execute();" << endl;
    outputFile << "        } catch (PDOException $e) {" << endl;
    outputFile << "            throw new Exception('Error al insertar configuracion: ' . $e->getMessage());" << endl;
    outputFile << "        }" << endl;
    outputFile << "    }" << endl;
    outputFile << "" << endl;

    // Método modificar
    outputFile << "    public function modificar" << modelName << "($parametro, $datos) {" << endl;
    outputFile << "        try {" << endl;
    outputFile << "            $query = $this->conexion->prepare(" << endl;
    outputFile << "                'UPDATE CONFIGURACION SET " << endl;

    for (size_t i = 1; i < attributes.size(); ++i) { // Excluir PARAMETRO como llave
        outputFile << "                    " << attributes[i] << " = :" << attributes[i];
        if (i < attributes.size() - 1) outputFile << ",";
        outputFile << endl;
    }

    outputFile << "                WHERE PARAMETRO = :parametro'" << endl;
    outputFile << "            );" << endl;

    for (size_t i = 1; i < attributes.size(); ++i) {
        outputFile << "            $query->bindParam(':" << attributes[i] << "', $datos['" << attributes[i] << "']);" << endl;
    }
    outputFile << "            $query->bindParam(':parametro', $parametro);" << endl;
    outputFile << "            return $query->execute();" << endl;
    outputFile << "        } catch (PDOException $e) {" << endl;
    outputFile << "            throw new Exception('Error al modificar configuracion: ' . $e->getMessage());" << endl;
    outputFile << "        }" << endl;
    outputFile << "    }" << endl;

    // Método eliminar
    outputFile << "    public function eliminar" << modelName << "($parametro) {" << endl;
    outputFile << "        try {" << endl;
    outputFile << "            $query = $this->conexion->prepare('DELETE FROM CONFIGURACION WHERE PARAMETRO = ?');" << endl;
    outputFile << "            $query->execute([$parametro]);" << endl;
    outputFile << "            return $query->rowCount() > 0;" << endl;
    outputFile << "        } catch (PDOException $e) {" << endl;
    outputFile << "            throw new Exception('Error al eliminar configuracion: ' . $e->getMessage());" << endl;
    outputFile << "        }" << endl;
    outputFile << "    }" << endl;

    // Cerrar clase
    outputFile << "}" << endl;
    outputFile << "?>" << endl;

    outputFile.close();
    cout << "Modelo generado correctamente: " << outputFileName << endl;
}

// Función principal
int main() {
    try {
        generateConfiguracionModel("modeloconfiguracionempresa.php");
    } catch (const exception &e) {
        cerr << "Error: " << e.what() << endl;
        return 1;
    }

    return 0;
}
