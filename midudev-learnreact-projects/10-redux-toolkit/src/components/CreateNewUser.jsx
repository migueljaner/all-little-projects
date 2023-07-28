import { Button, Card, TextInput, Title } from "@tremor/react";
import { useUserActions } from "../hooks/useUserActions";

export function CreateNewUser() {
	const { addUser } = useUserActions();

	const handleSubmit = (event) => {
		event.preventDefault();

		const form = event.target;

		const formData = new FormData(form);

		const name = formData.get("name");
		const email = formData.get("email");
		const github = formData.get("github");

        //Make form validation here
        

		addUser({ name, email, github });
		form.reset();
	};

	return (
		<Card style={{ marginTop: "16px" }}>
			<Title>Crear nuevo usuario</Title>

			<form action="" className="" onSubmit={handleSubmit}>
				<TextInput placeholder="Nombre" name="name" />
				<TextInput placeholder="Email" name="email" />
				<TextInput placeholder="Github" name="github" />
				<div>
					<Button style={{ marginTop: "16px" }}>Crear</Button>
				</div>
			</form>
		</Card>
	);
}
