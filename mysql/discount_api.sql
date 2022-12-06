DROP TABLE IF EXISTS Products;

CREATE TABLE Products (
    sku varchar(255),
    name varchar(255),
    category varchar(255),
    price int
);

DROP TABLE IF EXISTS CategoryDiscounts;

CREATE TABLE CategoryDiscounts (
    category varchar(255),
    discount_perc int,
    dicount_absolute int
);

DROP TABLE IF EXISTS ProductDiscounts;

CREATE TABLE ProductDiscounts (
    product_sku varchar(255),
    discount_perc int,
    dicount_absolute int
);

INSERT INTO 
	Products(sku, name, category, price)
VALUES
	('000001', 'BV Lean leather ankle boots', 'boots', '89000'),
    ('000002', 'BV Lean leather ankle boots', 'boots', '99000'),
    ('000003', 'Ashlington leather ankle boots', 'boots', '71000'),
    ('000004', 'Naima embellished suede sandals', 'sandals', '79500'),
    ('000005', 'Nathane leather sneakers', 'sneakers', '59000');

INSERT INTO 
	CategoryDiscounts(category, discount_perc)
VALUES 
    ('boots', '30');

INSERT INTO 
	ProductDiscounts(product_sku, discount_perc)
VALUES 
    ('000003', '15');