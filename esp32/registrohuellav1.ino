#include <Adafruit_Fingerprint.h>
#include <HardwareSerial.h>

// Pines RX y TX del sensor de huella conectados al ESP32
#define RXD2 16
#define TXD2 17

HardwareSerial mySerial(2); // UART2

Adafruit_Fingerprint finger = Adafruit_Fingerprint(&mySerial);
uint8_t id;

void setup() {
  Serial.begin(9600);
  mySerial.begin(57600, SERIAL_8N1, RXD2, TXD2);

  Serial.println("\n\nSensor de Huella Digital - Registro de Huella");

  finger.begin(57600);
  if (finger.verifyPassword()) {
    Serial.println("¡Sensor de huella encontrado!");
  } else {
    Serial.println("No se encontró el sensor de huella :(");
    while (true) { delay(1); }
  }

  Serial.println("Leyendo parámetros del sensor...");
  finger.getParameters();
  Serial.print("Estado: 0x"); Serial.println(finger.status_reg, HEX);
  Serial.print("ID del Sistema: 0x"); Serial.println(finger.system_id, HEX);
  Serial.print("Capacidad: "); Serial.println(finger.capacity);
  Serial.print("Nivel de seguridad: "); Serial.println(finger.security_level);
  Serial.print("Dirección del dispositivo: "); Serial.println(finger.device_addr, HEX);
  Serial.print("Longitud del paquete: "); Serial.println(finger.packet_len);
  Serial.print("Baud rate: "); Serial.println(finger.baud_rate);
}

uint8_t leerNumero() {
  uint8_t num = 0;
  while (num == 0) {
    while (!Serial.available());
    num = Serial.parseInt();
  }
  return num;
}

void loop() {
  Serial.println("Listo para registrar una huella...");
  Serial.println("Escribe el ID (del 1 al 127) para guardar esta huella:");
  id = leerNumero();
  if (id == 0) return;

  Serial.print("Registrando ID #");
  Serial.println(id);

  while (!registrarHuella());
}

uint8_t registrarHuella() {
  int p = -1;
  Serial.print("Esperando un dedo válido para registrar como #"); Serial.println(id);
  while (p != FINGERPRINT_OK) {
    p = finger.getImage();
    switch (p) {
      case FINGERPRINT_OK:
        Serial.println("Imagen capturada");
        break;
      case FINGERPRINT_NOFINGER:
        Serial.print(".");
        break;
      case FINGERPRINT_PACKETRECIEVEERR:
        Serial.println("Error de comunicación");
        break;
      case FINGERPRINT_IMAGEFAIL:
        Serial.println("Error al tomar imagen");
        break;
      default:
        Serial.println("Error desconocido");
        break;
    }
  }

  p = finger.image2Tz(1);
  switch (p) {
    case FINGERPRINT_OK:
      Serial.println("Imagen convertida");
      break;
    case FINGERPRINT_IMAGEMESS:
      Serial.println("Imagen muy borrosa");
      return p;
    case FINGERPRINT_FEATUREFAIL:
    case FINGERPRINT_INVALIDIMAGE:
      Serial.println("No se pudieron detectar características");
      return p;
    default:
      Serial.println("Error desconocido");
      return p;
  }

  Serial.println("Retira el dedo...");
  delay(2000);
  while (finger.getImage() != FINGERPRINT_NOFINGER);

  Serial.println("Coloca el mismo dedo de nuevo");
  while ((p = finger.getImage()) != FINGERPRINT_OK) {
    if (p == FINGERPRINT_NOFINGER) Serial.print(".");
    else if (p == FINGERPRINT_PACKETRECIEVEERR) Serial.println("Error de comunicación");
    else Serial.println("Error desconocido");
  }

  p = finger.image2Tz(2);
  if (p != FINGERPRINT_OK) {
    Serial.println("No se pudo procesar la segunda imagen");
    return p;
  }

  Serial.print("Creando modelo para #"); Serial.println(id);
  p = finger.createModel();
  if (p == FINGERPRINT_OK) {
    Serial.println("¡Huella verificada!");
  } else if (p == FINGERPRINT_ENROLLMISMATCH) {
    Serial.println("Las huellas no coinciden");
    return p;
  } else {
    Serial.println("Error creando modelo");
    return p;
  }

  p = finger.storeModel(id);
  if (p == FINGERPRINT_OK) {
    Serial.println("¡Huella almacenada con éxito!");
  } else {
    Serial.println("Error al guardar la huella");
    return p;
  }

  return true;
}
