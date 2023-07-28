import type { LinksFunction } from "@remix-run/node";
import styles from "./NewNote.css";
import { Form, useNavigation } from "@remix-run/react";

export const links: LinksFunction = () => [{ rel: "stylesheet", href: styles }];

const NewNote = () => {
  const navigation = useNavigation();

  const isSubmiting = navigation.state === "submitting";

  return (
    <Form method="post" id="note-form">
      <p>
        <label htmlFor="title">Title</label>
        <input type="text" id="title" name="title" required />
      </p>
      <p>
        <label htmlFor="content">Content</label>
        <textarea id="content" name="content" rows={5} required />
      </p>
      <div className="form-actions">
        <button disabled={isSubmiting}>
          {isSubmiting ? "Adding..." : "Add Note"}
        </button>
      </div>
    </Form>
  );
};

export default NewNote;
