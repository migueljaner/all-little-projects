import { useState } from 'react';
import Products from './components/Products.jsx';
import { products as initialProducts } from './mocks/products.json';
import Header from './components/Header.jsx';
import { Footer } from './components/Footer.jsx';
import { IS_DEV } from './config.js';
import { useFilters } from './hooks/useFilters.jsx';
import Cart from './components/Cart.jsx';
import { CartProvider } from './context/Cart.jsx';

function App() {
  const [products] = useState(initialProducts);
  const { filter, filterProducts } = useFilters();
  const filteredProducts = filterProducts(products);

  return (
    <CartProvider>
      <Header />
      <Cart />
      <Products products={filteredProducts} />
      {IS_DEV && <Footer filters={filter} />}
    </CartProvider>
  );
}

export default App;
