/* SQL for the pages of the store frontend module */

-- #P001

SELECT products.id, products.name, products.description, products.base_cost as price, categories.name as category, files.path as file
FROM products,categories,files
WHERE products.category_id=categories.id AND categories.store_id=1 AND files.id=products.image_id
ORDER BY insertion_date DESC
LIMIT 20;


