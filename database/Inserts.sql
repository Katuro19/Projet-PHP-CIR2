-- Don't forget to use this after creating the database or you'll cry later on


BEGIN;

INSERT INTO "expertise" VALUES (0,'Cardiology'), (1,'Pediatrics'), (2,'Orthopedics'), (3,'Dermatology'), (4,'Neurology'), (5,'Psychology');

INSERT INTO "locations" values (0,'GreatCity','12500'), (1,'DownTown','21600'), (2,'AquaCity','80800'), (3,'Senatus populusque Romanus','50927');

INSERT INTO "patients" values (0,'Kévin','Pereira','thisIsMyRealEmail@gmail.com','0771749163','cryptedPassword');
INSERT INTO "patients" values (1,'Louis','Lacoste','anotherRealEmail@gmail.com','0620239690','password');

INSERT INTO "doctors" values (0,'Oscar','Lavigne','yesyes@outlook.com','0649777963','verydemurepassword','78500',5);
INSERT INTO "doctors" values (1,'Pierre-Luc','Maurice','another@outlook.com','0636099659','sheep','89000',0);

INSERT INTO "rendezvous" values (0,'25/01/0470','08:00','09:30',0 ,0, 3);
INSERT INTO "rendezvous"(id, date, start, "end", doctor_id, location_id) VALUES (1, '25/01/2024', '08:00', '09:30', 0, 3);
INSERT INTO "rendezvous" VALUES (2, '26/01/2024', '08:00', '09:30',1 ,0, 2);
INSERT INTO "rendezvous" VALUES (3, '26/01/2024', '08:00', '09:30',0 ,1, 2);
INSERT INTO "rendezvous" VALUES (4, '16/12/2024', '08:30', '09:30', 0, 1, 2);
INSERT INTO "rendezvous" VALUES (5, '17/12/2024', '10:15', '11:45', 0, 0, 3);
INSERT INTO "rendezvous" VALUES (6, '18/12/2024', '14:00', '15:00', 0, 1, 1);
INSERT INTO "rendezvous" VALUES (7, '19/12/2024', '09:00', '10:00', 0, 0, 0);
INSERT INTO "rendezvous" VALUES (8, '20/12/2024', '16:45', '18:15', 0, 1, 3);
INSERT INTO "rendezvous" VALUES (9, '21/12/2024', '18:00', '19:30', 0, 0, 2);



-- Exemples: 
/* select d.firstname as "Doctors name", p.firstname as "Patient name", l.name as "Location" from rendezvous as rv join doctors d on rv.doctor_id = d.id join patients p on rv.patient_id = p.id join locations l on rv.location_id = l.id;


*/