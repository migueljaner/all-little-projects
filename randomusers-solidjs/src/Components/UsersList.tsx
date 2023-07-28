import { Button, Td, Tr } from "@hope-ui/solid";
import { User } from "../types";
import { Accessor, Component } from "solid-js";

type Props = {
  user: User;
  index: Accessor<number>;
  handleDelete: (uuid: string, index: Accessor<number>) => void;
};

const UsersList: Component<Props> = ({ user, handleDelete, index }) => {
  return (
    <Tr>
      <Td>{user.email}</Td>
      <Td>{`${user.name.first} ${user.name.last}`}</Td>
      <Td>
        <Button size="sm" onClick={() => handleDelete(user.login.uuid, index)}>
          Delete
        </Button>
      </Td>
    </Tr>
  );
};

export default UsersList;
