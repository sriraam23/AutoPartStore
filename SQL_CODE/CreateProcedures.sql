DROP PROCEDURE IF EXISTS customer_history;
DROP PROCEDURE IF EXISTS supplier_history;

DELIMITER $$
CREATE PROCEDURE `customer_history`(IN CID INT)
BEGIN
	SELECT * FROM Orders, OInventory where OInventory.OrderID = Orders.OrderID AND Orders.CustomerID = CID;
END$$

CREATE PROCEDURE `supplier_history`(IN Supplier_ID INT)
BEGIN
	SELECT *
    FROM Supplies
    WHERE SupplierID = Supplier_ID;

END$$
DELIMITER ;
