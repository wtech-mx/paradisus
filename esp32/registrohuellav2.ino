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

  Serial.print("Iniciando registro de huella en ID #"); Serial.println(id);
  bool exitoso = true;

  for (int intento = 1; intento <= 3; intento++) {
    Serial.print(">>> Registro intento "); Serial.println(intento);
    if (!registrarHuellaTemporal()) {
      Serial.println("❌ Falló la captura de esta ronda");
      exitoso = false;
      break;
    }
    delay(1000);
  }

  if (exitoso) {
    int p = finger.storeModel(id);
    if (p == FINGERPRINT_OK) {
      Serial.println("✅ ¡Huella registrada exitosamente!");
    } else {
      Serial.println("❌ Error al guardar la huella final");
    }
  } else {
    Serial.println("❌ Registro cancelado. Intenta nuevamente.");
  }
}

bool registrarHuellaTemporal() {
  int p = -1;
  Serial.println("Coloca el dedo...");
  while ((p = finger.getImage()) != FINGERPRINT_OK) {
    if (p == FINGERPRINT_NOFINGER) Serial.print(".");
    else Serial.println("Error al capturar imagen");
    delay(100);
  }

  p = finger.image2Tz(1);
  if (p != FINGERPRINT_OK) {
    Serial.println("❌ Error procesando imagen");
    return false;
  }

  Serial.println("Retira el dedo...");
  delay(1500);
  while (finger.getImage() != FINGERPRINT_NOFINGER);

  Serial.println("Coloca el mismo dedo otra vez...");
  while ((p = finger.getImage()) != FINGERPRINT_OK) {
    if (p == FINGERPRINT_NOFINGER) Serial.print(".");
    else Serial.println("Error al capturar imagen");
    delay(100);
  }

  p = finger.image2Tz(2);
  if (p != FINGERPRINT_OK) {
    Serial.println("❌ Error procesando segunda imagen");
    return false;
  }

  p = finger.createModel();
  if (p == FINGERPRINT_OK) {
    Serial.println("✔ Modelo temporal creado correctamente");
    return true;
  } else if (p == FINGERPRINT_ENROLLMISMATCH) {
    Serial.println("❌ Las huellas no coinciden");
    return false;
  } else {
    Serial.println("❌ Error al crear el modelo");
    return false;
  }
}
