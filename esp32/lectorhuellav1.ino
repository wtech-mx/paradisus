#include <Adafruit_Fingerprint.h>
#include <HardwareSerial.h>

// Pines conectados al sensor de huella
#define RXD2 16
#define TXD2 17

HardwareSerial mySerial(2); // UART2 en ESP32
Adafruit_Fingerprint finger = Adafruit_Fingerprint(&mySerial);

void setup() {
  Serial.begin(9600);
  mySerial.begin(57600, SERIAL_8N1, RXD2, TXD2);
  delay(100);

  Serial.println("\n\nPrueba de detección de huella con ESP32");

  finger.begin(57600);
  delay(5);

  if (finger.verifyPassword()) {
    Serial.println("¡Sensor de huella detectado correctamente!");
  } else {
    Serial.println("No se detectó el sensor de huella :(");
    while (true) { delay(1); }
  }

  Serial.println("Leyendo parámetros del sensor...");
  finger.getParameters();
  Serial.print("Estado: 0x"); Serial.println(finger.status_reg, HEX);
  Serial.print("ID del sistema: 0x"); Serial.println(finger.system_id, HEX);
  Serial.print("Capacidad: "); Serial.println(finger.capacity);
  Serial.print("Nivel de seguridad: "); Serial.println(finger.security_level);
  Serial.print("Dirección del dispositivo: "); Serial.println(finger.device_addr, HEX);
  Serial.print("Tamaño del paquete: "); Serial.println(finger.packet_len);
  Serial.print("Baud rate: "); Serial.println(finger.baud_rate);

  finger.getTemplateCount();
  if (finger.templateCount == 0) {
    Serial.println("El sensor no contiene huellas registradas. Por favor, ejecuta el código de registro.");
  } else {
    Serial.print("El sensor contiene "); Serial.print(finger.templateCount); Serial.println(" huellas registradas.");
    Serial.println("Esperando una huella válida...");
  }
}

void loop() {
  verificarHuella();
  delay(50); // No se necesita correr esto tan rápido
}

uint8_t verificarHuella() {
  uint8_t p = finger.getImage();
  switch (p) {
    case FINGERPRINT_OK:
      Serial.println("Imagen capturada");
      break;
    case FINGERPRINT_NOFINGER:
      // No mostramos nada si no hay dedo
      return p;
    case FINGERPRINT_PACKETRECIEVEERR:
      Serial.println("Error de comunicación");
      return p;
    case FINGERPRINT_IMAGEFAIL:
      Serial.println("Error al capturar imagen");
      return p;
    default:
      Serial.println("Error desconocido");
      return p;
  }

  p = finger.image2Tz();
  switch (p) {
    case FINGERPRINT_OK:
      Serial.println("Imagen convertida correctamente");
      break;
    case FINGERPRINT_IMAGEMESS:
      Serial.println("Imagen demasiado borrosa");
      return p;
    case FINGERPRINT_PACKETRECIEVEERR:
      Serial.println("Error de comunicación");
      return p;
    case FINGERPRINT_FEATUREFAIL:
    case FINGERPRINT_INVALIDIMAGE:
      Serial.println("No se encontraron características válidas en la imagen");
      return p;
    default:
      Serial.println("Error desconocido");
      return p;
  }

  p = finger.fingerSearch();
  if (p == FINGERPRINT_OK) {
    Serial.println("¡Huella coincidente encontrada!");
  } else if (p == FINGERPRINT_NOTFOUND) {
    Serial.println("No se encontró coincidencia");
    return p;
  } else {
    Serial.println("Error durante la búsqueda de huella");
    return p;
  }

  Serial.print("ID encontrado: #"); Serial.print(finger.fingerID);
  Serial.print(" con nivel de confianza: "); Serial.println(finger.confidence);

  return finger.fingerID;
}

// Alternativa simple, retorna -1 si falla
int verificarHuellaRapida() {
  if (finger.getImage() != FINGERPRINT_OK) return -1;
  if (finger.image2Tz() != FINGERPRINT_OK) return -1;
  if (finger.fingerFastSearch() != FINGERPRINT_OK) return -1;

  Serial.print("ID encontrado: #"); Serial.print(finger.fingerID);
  Serial.print(" con nivel de confianza: "); Serial.println(finger.confidence);
  return finger.fingerID;
}
