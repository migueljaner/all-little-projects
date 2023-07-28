import { createContext, useReducer } from 'react';

export const CartContext = createContext();

const initalState = [];

const reducer = (state, action) => {
  const { type: actionType, payload: actionPayload } = action;

  switch (actionType) {
    case 'ADD_TO_CART': {
      const { id } = actionPayload;
      const productInCartIndex = state.findIndex((item) => item.id === id);

      if (productInCartIndex >= 0) {
        const newCart = [...state]; //Usando spread operator
        newCart[productInCartIndex].quantity += 1;
        return newCart;
      }

      return [...state, { ...actionPayload, quantity: 1 }];
    }
    case 'REMOVE_ONE_FROM_CART': {
      const { id } = actionPayload;
      const productInCartIndex = state.findIndex((item) => item.id === id);

      if (productInCartIndex >= 0) {
        const newCart = [...state];
        newCart[productInCartIndex].quantity -= 1;

        if (newCart[productInCartIndex].quantity === 0) {
          newCart.splice(productInCartIndex, 1);
        }

        return newCart;
      }

      return state;
    }

    case 'REMOVE_FROM_CART': {
      const { id } = actionPayload;
      return state.findIndex((item) => item.id === id);
    }
    case 'CLEAR_CART': {
      return initalState;
    }
  }
  return state;
};

export function CartProvider({ children }) {
  //Usando useState
  // const [cart, setCart] = useState([]);

  // const addToCart = (product) => {
  //   //Check if product is already in cart
  //   const productInCart = cart.findIndex((item) => item.id === product.id);

  //   if (productInCart >= 0) {
  //     //Usando structuredClone
  //     const newCart = structuredClone(cart);
  //     newCart[productInCart].quantity += 1;
  //     return setCart(newCart);
  //   }
  //   /* if (productInCart >= 0) {
  //       //Usnado map
  //     const updatedCart = cart.map((item) => {
  //       if (item.id === product.id) {
  //         return {
  //           ...item,
  //           quantity: item.quantity + 1,
  //         };
  //       }
  //       return item;
  //     });
  //     return setCart(updatedCart);
  //   } */

  //   setCart((prevCart) => [...prevCart, { ...product, quantity: 1 }]);
  // };

  // const removeOneFromCart = (product) => {
  //   const productInCart = cart.findIndex((item) => item.id === product.id);

  //   if (productInCart >= 0) {
  //     const newCart = structuredClone(cart);
  //     newCart[productInCart].quantity -= 1;
  //     if (newCart[productInCart].quantity === 0) {
  //       newCart.splice(productInCart, 1);
  //     }
  //     return setCart(newCart);
  //   }
  // };
  // const removeFromCart = (productId) => {
  //   const newCart = cart.filter((item) => item.id !== productId);
  //   setCart(newCart);
  // };
  // const clearCart = () => {
  //   setCart([]);
  // };

  const [state, dispatch] = useReducer(reducer, initalState);

  const addToCart = (product) => {
    dispatch({ type: 'ADD_TO_CART', payload: product });
  };

  const removeFromCart = (product) => {
    dispatch({ type: 'REMOVE_FROM_CART', payload: product });
  };

  const clearCart = () => {
    dispatch({ type: 'CLEAR_CART' });
  };

  const removeOneFromCart = (product) => {
    dispatch({ type: 'REMOVE_ONE_FROM_CART', payload: product });
  };

  return (
    <CartContext.Provider
      value={{
        cart: state,
        addToCart,
        removeFromCart,
        removeOneFromCart,
        clearCart,
      }}
    >
      {children}
    </CartContext.Provider>
  );
}
