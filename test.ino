#include <ESP8266WiFi.h>
#include <WiFiClient.h>

const char* ssid = "Your_SSID";        // Replace with your Wi-Fi SSID
const char* password = "Your_PASSWORD"; // Replace with your Wi-Fi password

WiFiServer server(80); // Create a server on port 80

void setup() {
  Serial.begin(115200);  // Start serial communication
  WiFi.begin(ssid, password);

  Serial.println();
  Serial.print("Connecting to Wi-Fi");

  while (WiFi.status() != WL_CONNECTED) {
    delay(500);
    Serial.print(".");
  }

  Serial.println();
  Serial.println("Connected!");
  Serial.print("IP Address: ");
  Serial.println(WiFi.localIP());

  server.begin(); // Start the server
}

void loop() {
  WiFiClient client = server.available(); // Listen for incoming clients

  if (client) {
    Serial.println("New client connected.");
    while (client.connected()) {
      if (client.available()) {
        String request = client.readStringUntil('\r');
        Serial.print("Received: ");
        Serial.println(request);

        // Echo response to the client
        client.println("HTTP/1.1 200 OK");
        client.println("Content-Type: text/plain");
        client.println();
        client.println("ESP8266 Wi-Fi Adapter is Active!");
        client.println(request);
        break;
      }
    }
    client.stop(); // Close the connection
    Serial.println("Client disconnected.");
  }

  // Handle Serial data from the computer
  if (Serial.available()) {
    String data = Serial.readString();
    Serial.print("Sending to Wi-Fi: ");
    Serial.println(data);

    WiFiClient client = server.available();
    if (client) {
      client.println(data);
    }
  }
}
