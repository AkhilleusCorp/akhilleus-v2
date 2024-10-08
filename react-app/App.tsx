import * as ReactDOM from "react-dom/client";
import AdminRouter from "./services/router/AdminRouter.tsx";

const root = document.getElementById("root")!;
ReactDOM.createRoot(root).render(<AdminRouter />);
