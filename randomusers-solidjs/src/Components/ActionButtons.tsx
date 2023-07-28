import { Button } from "@suid/material";
import { Component, Setter } from "solid-js";

interface Props {
  setNextPage: Setter<number>;
  setSort: Setter<boolean>;
  handleReset: () => void;
}

const ActionButtons: Component<Props> = ({
  setNextPage,
  setSort,
  handleReset,
}) => {
  return (
    <div>
      <Button
        color="success"
        variant="contained"
        style={{ margin: "10px" }}
        onClick={() => setNextPage((prev) => prev + 1)}
      >
        Next Page
      </Button>
      <Button
        color="warning"
        variant="contained"
        style={{ margin: "10px" }}
        onClick={() => setSort((prev) => !prev)}
      >
        Sort
      </Button>
      <Button
        color="error"
        variant="contained"
        style={{ margin: "10px" }}
        onClick={() => handleReset()}
      >
        Reset
      </Button>
    </div>
  );
};

export default ActionButtons;
