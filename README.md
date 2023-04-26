# OnlineQuiz
Hier entsteht ein Prototyp für ein OnlineQuiz (WebApp).

Das Projekt ist in einen DatenLayer, BusinessLayer und ViewLayer aufgeteilt.

Durch den Aufbau der Anwendung in diesem Muster könnte man theoretisch aus der WebApp eine KonsolenAnwendung machen ohne die Logik ändern zu müssen. 

Der DatenLayer stellt die Verbindung zur Datenbank dar. Das heißt er sendet die Datenbankabfragen an den SQL-Server und empfängt die Nachrichten.

Der BusinessLayer stellt die Logik der Anwendung dar. Das heißt er empfängt Objekte von der UI und wandelt diese in Modelle der Datenbank um. Dabei werden auch Logik-Sachen, wie z.B. Berechtigungen gesteuert.

ViewLayer stellt die grafische Darstellung der Daten dar. Hier werden die von der BusinessLogik erstellten Objekte dargestellt bzw. befüllt.
