import { AddToCartIcon, RemoveFromCartIcon } from './Icons';
import './Products.css';
import { CartContext } from '../context/Cart';
import { useCart } from '../hooks/useCart';

const Products = ({ products }) => {
  const { addToCart, cart, removeFromCart } = useCart(CartContext);

  const checkProductInCart = (product) => {
    return cart.some((item) => item.id === product.id);
  };

  return (
    <main className="products">
      <ul>
        {products.slice(0, 10).map((product) => { // slice(0, 10) is used to limit the number of products displayed 
          const isProductInCart = checkProductInCart(product);
          return (
            <li key={product.id}>
              <img src={product.thumbnail} alt={product.title} />
              <div>
                <strong>{product.title}</strong> - ${product.price}
              </div>
              <div>
                <button
                  style={{ backgroundColor: isProductInCart ? 'red' : 'green' }}
                  onClick={
                    !isProductInCart
                      ? () => {
                          addToCart(product);
                        }
                      : () => {
                          removeFromCart(product.id);
                        }
                  }
                >
                  {isProductInCart ? <RemoveFromCartIcon /> : <AddToCartIcon />}
                </button>
              </div>
            </li>
          );
        })}
      </ul>
    </main>
  );
};

export default Products;
