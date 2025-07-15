#include <Adafruit_Fingerprint.h>
#include <HardwareSerial.h>
#include <WiFi.h>
#include <HTTPClient.h>

// Pines conectados al sensor de huella
#define RXD2 16
#define TXD2 17

// Pines para LEDs
#define LED_ROJO     18  // D18
#define LED_AMARILLO 19  // D19
#define LED_VERDE    21  // D21

// WiFi
const char* ssid = "INFINITUMD226";
const char* password = "xXTWR474G7";

// Servidor PHP que guarda los datos
const char* serverUrl = "http://paradisus.mx/api/huella-post";

HardwareSerial mySerial(2); // UART2 en ESP32
Adafruit_Fingerprint finger = Adafruit_Fingerprint(&mySerial);

void setup() {
  Serial.begin(9600);
  mySerial.begin(57600, SERIAL_8N1, RXD2, TXD2);
  delay(100);

  // Inicializar pines de LED
  pinMode(LED_ROJO, OUTPUT);
  pinMode(LED_AMARILLO, OUTPUT);
  pinMode(LED_VERDE, OUTPUT);

  apagarTodosLosLeds();

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
    prenderLedError();
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
  prenderLedEspera(); // LED amarillo encendido esperando huella

  uint8_t p = finger.getImage();
  if (p != FINGERPRINT_OK) {
    apagarTodosLosLeds();
    return p;
  }

  p = finger.image2Tz();
  if (p != FINGERPRINT_OK) {
    prenderLedError();
    return p;
  }

  p = finger.fingerSearch();
  if (p != FINGERPRINT_OK) {
    Serial.println("Huella no encontrada");
    prenderLedError();
    return p;
  }

  int idDetectado = finger.fingerID;
  int idBase = normalizarID(idDetectado);

  Serial.print("ID detectado: #"); Serial.print(idDetectado);
  Serial.print(" → ID base asignado: #"); Serial.println(idBase);
  Serial.print("Confianza: "); Serial.println(finger.confidence);

  prenderLedOk(); // LED verde encendido por 1.5s
  enviarRegistro(idBase, finger.confidence);

  return idDetectado;
}

// Agrupamos los IDs en bloques de 3
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

// === Funciones LED ===
void apagarTodosLosLeds() {
  digitalWrite(LED_ROJO, LOW);
  digitalWrite(LED_AMARILLO, LOW);
  digitalWrite(LED_VERDE, LOW);
}

void prenderLedEspera() {
  apagarTodosLosLeds();
  digitalWrite(LED_AMARILLO, HIGH);
}

void prenderLedOk() {
  apagarTodosLosLeds();
  digitalWrite(LED_VERDE, HIGH);
  delay(1500);
  apagarTodosLosLeds();
}

void prenderLedError() {
  apagarTodosLosLeds();
  digitalWrite(LED_ROJO, HIGH);
  delay(1500);
  apagarTodosLosLeds();
}
