import { redirect, type LinksFunction } from "@remix-run/node";
import { useLoaderData } from "@remix-run/react";
import NewNote, { links as newNoteLinks } from "~/components/NewNote";
import NoteList, { links as noteListLinks } from "~/components/NoteList";
import { type Note, getStoredNotes, storeNotes } from "~/data/notes";

export const links: LinksFunction = () => [
  ...newNoteLinks(),
  ...noteListLinks(),
];

//create a action function to add new note
export async function action({ request }: { request: Request }) {
  const formData = await request.formData();
  const title = formData.get("title") as string;
  const content = formData.get("content") as string;
  const id = Date.now().toString();
  //save the note to the notes.json file
  const newNote: Note = { id, title, content };

  const oldNotes = await getStoredNotes();

  const newNotes = [...oldNotes, newNote];

  await storeNotes(newNotes);

  return redirect("/notes");
}

//Load the notes form the notes.json file
export async function loader() {
  const notes = await getStoredNotes();

  return notes;
}

export default function NotesPages() {
  const notes = useLoaderData<Note[]>();

  return (
    <main id="content">
      <NewNote />
      <NoteList notes={notes} />
    </main>
  );
}
