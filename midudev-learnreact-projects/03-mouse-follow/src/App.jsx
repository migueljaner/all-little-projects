import { useEffect, useState } from "react";
import "./App.css";

const App = () => {
  const [enable, setEnabled] = useState(false);
  const [position, setPosition] = useState({ x: 0, y: 0 });

  useEffect(() => {
    const handleMove = (event) => {
      const { clientX, clientY } = event;
      setPosition({ x: clientX, y: clientY });
    };
    if (enable) {
      window.addEventListener("pointermove", handleMove);
    }

    //Cleanup
    //Cuando el componente se desmonta
    //Cuando cambian las dependencias
    return () => {
      window.removeEventListener("pointermove", handleMove);
    };
  }, [enable]);

  const clickHandler = () => {
    setEnabled((enable) => !enable);
  };

  return (
    <main>
      <div
        style={{
          position: "absolute",
          backgroundColor: "#09f",
          borderRadius: "50%",
          opacity: 0.8,
          pointerEvents: "none",
          left: -20,
          top: -20,
          width: 40,
          height: 40,
          transform: `translate(${position.x}px, ${position.y}px)`,
        }}
      />
      <button onClick={clickHandler}>
        {!enable ? "Activar" : "Desactivar"} seguir puntero
      </button>
    </main>
  );
};

export default App;
