# Basket Application

This project is a PHP-based application that allows users to manage a basket of products, calculate total prices, and apply delivery rules and offers.

## Features

- Add products to the basket by their code.
- Calculate the total price of the basket, including delivery costs.
- Apply offers such as discounts on specific products.
- Fully tested with PHPUnit.

## Requirements

- PHP 8.3 or higher
- Composer
- Docker and Docker Compose

## Installation

1. Clone the repository:
   ```bash
   git clone git@github.com:jebersole/acme.git
   cd acme

## Running Tests

To run the tests, use the `make test` command from the command line:

```bash
make test
```

This will:
1. Start the Docker containers and install any necessary dependencies.
2. Execute the PHPUnit tests inside the `php_app` container.
3. Stop and remove the containers after the tests are complete.

## Example Usage

Here is an example of how to use the `Basket` class with dependency injection:

```php
use DI\ContainerBuilder;
use App\Baskets\Basket;

require_once __DIR__ . '/vendor/autoload.php';

// Set up the dependency injection container
$containerBuilder = new ContainerBuilder();
$container = $containerBuilder->build();

// Resolve the Basket class with its dependencies
$basket = $container->get(Basket::class);

// Add products to the basket
$basket->addProductByCode('B01');
$basket->addProductByCode('R02');

// Get the total price
echo $basket->getTotalPrice();
```

## Test Cases

The following test cases are included in the project:

### `testAddProductByCode`
- Adds a product to the basket by its code.
- Verifies the product count and total price.

### `testGetTotalPriceWithOffer`
- Adds two `RedWidget` products to the basket.
- Verifies the total price with a "buy one, get the second at half price" offer.

### `testLowCostDelivery`
- Adds multiple products to the basket.
- Verifies the total price with a low-cost delivery fee.

### `testFreeDelivery`
- Adds four `GreenWidget` products to the basket.
- Verifies the total price with free delivery.

### `testBlueAndGreenBasket`
- Adds a `BlueWidget` and a `GreenWidget` to the basket.
- Verifies the total price.

### `testRedAndGreenBasket`
- Adds a `RedWidget` and a `GreenWidget` to the basket.
- Verifies the total price.

### `testBlueAndRedBasket`
- Adds two `BlueWidget` products and three `RedWidget` products to the basket.
- Verifies the total price.

## Project Structure

- `app/`: Contains the application code.
- `tests/`: Contains the PHPUnit test cases.
- `docker-compose.yml`: Configuration for Docker containers.
- `Makefile`: Simplifies running commands like testing.
- `composer.json`: Manages PHP dependencies.