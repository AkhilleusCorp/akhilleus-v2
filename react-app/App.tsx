import * as ReactDOM from "react-dom/client";
import Router from "./infrastructure/router/Router.tsx";

const root = document.getElementById("root")!;
ReactDOM.createRoot(root).render(<Router />);
