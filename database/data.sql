-- Don't forget to use this after creating the database or you'll cry later on
-- Note that this is using ID !! This will NOT work if you used the database before, bcs the primary key keep incrementing. Please delete and re-create the db.

BEGIN;

INSERT INTO expertise("name") VALUES
('Cardiology'), ('Pediatrics'), ('Orthopedics'), ('Dermatology'), ('Neurology'), ('Psychology');


INSERT INTO locations("name","postcode") VALUES
('GreatCity','12500'), ('DownTown','21600'), ('AquaCity','80800'), ('Senatus populusque Romanus','50927');

INSERT INTO patients(firstname,lastname,email,phone,"password") VALUES
('Kévin','Pereira','thisIsMyRealEmail@gmail.com','0771749163','cryptedPassword'),
('Louis','Lacoste','anotherRealEmail@gmail.com','0620239690','password');

INSERT INTO doctors(firstname,lastname,email,phone,"password",postcode,expertise_id) VALUES 
('Oscar','Lavigne','yesyes@outlook.com','0649777963','verydemurepassword','78500',6),
('Pierre-Luc','Maurice','another@outlook.com','0636099659','sheep','89000',1);

INSERT INTO "rendezvous"("date", "start", "end", patient_id, doctor_id, location_id) VALUES
('25/01/0470','08:00','09:30',1 ,1, 4),
('25/01/2024', '08:00', '09:30',null, 1, 4),
('26/01/2024', '08:00', '09:30',2 ,1, 3),
('26/01/2024', '08:00', '09:30',1 ,2, 3),
('16/12/2024', '08:30', '09:30', 1, 2, 3),
('17/12/2024', '10:15', '11:45', 1, 1, 4),
('18/12/2024', '14:00', '15:00', 2, 2, 2),
('19/12/2024', '09:00', '10:00', 1, 1, 1),
('20/12/2024', '16:45', '18:15', 2, 2, 4),
('21/12/2024', '18:00', '19:30', 1, 1, 3);



-- Exemples: 
/* select d.firstname as "Doctors name", p.firstname as "Patient name", l.name as "Location" from rendezvous as rv join doctors d on rv.doctor_id = d.id join patients p on rv.patient_id = p.id join locations l on rv.location_id = l.id;


*/