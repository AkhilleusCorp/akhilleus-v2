import * as ReactDOM from "react-dom/client";
import AdminRouter from "./services/router/AdminRouter.tsx";
import {Provider} from "react-redux";
import {store} from "./services/redux";
import {StrictMode} from "react";

const root = document.getElementById("root")!;
ReactDOM.createRoot(root).render(
    <StrictMode>
        <Provider store={store}>
            <AdminRouter />
        </Provider>
    </StrictMode>
);
