<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Producto>
 */
class ProductoFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'codigo' => $this->faker->unique()->ean13(), //codigo unico
            'nombre' => $this->faker->word(), //Nombre aleatorio
            'descripcion' => $this->faker->sentence(), //Descripcion aleatoria
            'imagen' => $this->faker->imageUrl(540,480,'productos', true), //url de una imagen aleatori
            'stock' => $this->faker->numberBetween(10,100), //stock entre 10 y 100
            'stock_minimo' => $this->faker->numberBetween(5,10), //stock minimo entre 5 y 10
            'stock_maximo' => $this->faker->numberBetween(50,200), //stock maximo entre 50 y 200
            'precio_compra' => $this->faker->randomFloat(2,10,500), // precio compra entre 10 y 500
            'precio_venta' => $this->faker->randomFloat(2,20,600), // precio compra entre 20 y 600
            'fecha_ingreso' => $this->faker->date(), //Fecha de ingreso aleatorio
            'categoria_id' => \App\Models\Categoria::factory(), //Relacion con la tabla categoria
            'empresa_id' => 1,
        ];
    }
}
