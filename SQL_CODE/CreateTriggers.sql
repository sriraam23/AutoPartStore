DROP TRIGGER IF EXISTS updateEDDate;
DROP TRIGGER IF EXISTS updateShip;
DROP TRIGGER IF EXISTS updateinv;

DELIMITER $$
CREATE TRIGGER `updateEDDate` BEFORE INSERT ON `Orders`
 FOR EACH ROW BEGIN
	IF new.storeID = 11 THEN
		set new.EDDate = now();
	END IF;
END$$

CREATE TRIGGER `updateShip` BEFORE UPDATE ON `Orders`
 FOR EACH ROW BEGIN
  IF  (new.DDate <> old.DDate) THEN 
  set new.Delivered = 1;
 ELSEIF (new.SDate <> old.SDate) THEN
		set new.Shipped = 1;	
 END IF;
END$$

CREATE TRIGGER `updateinv` BEFORE INSERT ON `OInventory`
 FOR EACH ROW Begin 
     DECLARE  quantity_create integer;
     DECLARE SID integer;
     
     SELECT StoreID into SID from Orders where OrderID = new.OrderID;
     
	Select StQuantity into quantity_create from SInventory where PartNo = new.PartNo and StoreID = SID;
    
       update SInventory set StQuantity = (quantity_create - new.OrQuantity) where StoreID = SID and PartNo = new.PartNo;
END$$
DELIMITER ;