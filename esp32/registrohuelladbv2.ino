#include <Adafruit_Fingerprint.h>
#include <HardwareSerial.h>
#include <WiFi.h>
#include <HTTPClient.h>

// Pines conectados al sensor de huella
#define RXD2 16
#define TXD2 17

// WiFi
const char* ssid = "INFINITUM89F7";
const char* password = "vC7yNaNE6y";

// Servidor PHP que guarda los datos
const char* serverUrl = "http://paradisus.mx/api/huella-post";

HardwareSerial mySerial(2); // UART2 en ESP32
Adafruit_Fingerprint finger = Adafruit_Fingerprint(&mySerial);

void setup() {
  Serial.begin(9600);
  mySerial.begin(57600, SERIAL_8N1, RXD2, TXD2);
  delay(100);

  WiFi.begin(ssid, password);
  Serial.print("Conectando a WiFi...");
  while (WiFi.status() != WL_CONNECTED) {
    delay(500);
    Serial.print(".");
  }
  Serial.println("\nConexión WiFi exitosa");
  Serial.print("IP: "); Serial.println(WiFi.localIP());

  finger.begin(57600);
  delay(5);

  if (finger.verifyPassword()) {
    Serial.println("¡Sensor de huella detectado correctamente!");
  } else {
    Serial.println("No se detectó el sensor de huella :(");
    while (true) { delay(1); }
  }

  finger.getTemplateCount();
  Serial.print("El sensor contiene "); Serial.print(finger.templateCount);
  Serial.println(" huellas registradas.");
}

void loop() {
  verificarHuella();
  delay(50);
}

uint8_t verificarHuella() {
  uint8_t p = finger.getImage();
  if (p != FINGERPRINT_OK) return p;

  p = finger.image2Tz();
  if (p != FINGERPRINT_OK) return p;

  p = finger.fingerSearch();
  if (p != FINGERPRINT_OK) {
    Serial.println("Huella no encontrada");
    return p;
  }

  int idDetectado = finger.fingerID;
  int idBase = normalizarID(idDetectado);

  Serial.print("ID detectado: #"); Serial.print(idDetectado);
  Serial.print(" → ID base asignado: #"); Serial.println(idBase);
  Serial.print("Confianza: "); Serial.println(finger.confidence);

  enviarRegistro(idBase, finger.confidence);

  return idDetectado;
}

// Esta función agrupa por bloques de 3 IDs consecutivos
int normalizarID(int id) {
  return (id / 3) * 3;
}

void enviarRegistro(int huella_id, int confianza) {
  if (WiFi.status() == WL_CONNECTED) {
    HTTPClient http;
    String postData = "huella_id=" + String(huella_id) + "&fidelidad=" + String(confianza);

    http.begin(serverUrl);
    http.addHeader("Content-Type", "application/x-www-form-urlencoded");

    int httpCode = http.POST(postData);

    if (httpCode > 0) {
      Serial.println("Código HTTP: " + String(httpCode));
      String respuesta = http.getString();
      Serial.println("Respuesta servidor: " + respuesta);
    } else {
      Serial.println("Error al enviar POST: " + String(httpCode));
    }

    http.end();
  } else {
    Serial.println("WiFi desconectado, no se pudo enviar");
  }
}
