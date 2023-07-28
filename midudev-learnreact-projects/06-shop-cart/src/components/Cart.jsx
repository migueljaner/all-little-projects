import { CartIcon, ClearCartIcon } from './Icons';
import './Cart.css';
import { useCart } from '../hooks/useCart';
import { useId } from 'react';

const CartItem = ({
  thumbnail,
  title,
  price,
  quantity,
  handleAddQuantity,
  handleRemoveQuantity,
}) => {
  return (
    <li>
      <img src={thumbnail} alt={title} />

      <div>
        <strong>{title}</strong> - ${price}
      </div>
      <footer>
        <button onClick={handleRemoveQuantity}>-</button>
        <small>Qty: {quantity}</small>
        <button onClick={handleAddQuantity}>+</button>
      </footer>
    </li>
  );
};

export default function Cart() {
  const cartCheckboxId = useId('cart-checkbox-');
  const cartId = useId('cart-');

  const { cart, clearCart, addToCart, removeOneFromCart } = useCart();

  return (
    <>
      <label className="cart-button" htmlFor={cartCheckboxId}>
        <CartIcon />
      </label>

      <input type="checkbox" id={cartCheckboxId} hidden />

      <aside className="cart" id={cartId}>
        <ul>
          {cart.map((product) => (
            <CartItem
              key={product.id}
              {...product}
              handleAddQuantity={() => addToCart(product)}
              handleRemoveQuantity={() => removeOneFromCart(product)}
            />
          ))}
        </ul>

        <button onClick={clearCart}>
          <ClearCartIcon />
        </button>
      </aside>
    </>
  );
}
