import streamlit as st
import pandas as pd
import plotly.express as px
import random

# Configuração da página
st.set_page_config(page_title="Qual filme assistir hoje?", layout="wide")

st.title("🎬 Qual filme assistir hoje?")
st.markdown("""
Escolha seu próximo filme em poucos cliques! 🍿  
Esta aplicação ajuda você a navegar por um catálogo de mais de 45 mil títulos para encontrar a opção ideal.
""")
st.caption("Desenvolvido por: Marcos Daniel da Silva Lima")

@st.cache_data
def load_data():
    df = pd.read_csv('movies_metadata.csv', low_memory=False)
    
    df['release_year'] = pd.to_datetime(df['release_date'], errors='coerce').dt.year
    df['vote_average'] = pd.to_numeric(df['vote_average'], errors='coerce')
    df['runtime'] = pd.to_numeric(df['runtime'], errors='coerce')
    df['popularity'] = pd.to_numeric(df['popularity'], errors='coerce')
    
    return df.dropna(subset=['title', 'vote_average', 'release_year', 'runtime', 'genres'])

df = load_data()


st.sidebar.header("Filtros de Seleção")

generos_disponiveis = ['Action', 'Comedy', 'Drama', 'Horror', 'Romance', 'Sci-Fi'] 
genero_sel = st.sidebar.multiselect("Selecione os Gêneros:", generos_disponiveis)

nota_min = st.sidebar.slider("Nota Mínima (0-10):", 0.0, 10.0, 7.0)

duracao_max = st.sidebar.slider("Duração Máxima (minutos):", 30, 300, 150)

anos_disponiveis = sorted(df['release_year'].unique().astype(int))
ano_inicial = anos_disponiveis[0]
ano_final = anos_disponiveis[-1]
ano_min, ano_max = st.sidebar.select_slider(
    "Intervalo de Anos de Lançamento:",
    options=anos_disponiveis,
    value=(ano_inicial, ano_final)
)

df_filtrado = df[
    (df['vote_average'] >= nota_min) &
    (df['runtime'] <= duracao_max) &
    (df['release_year'].between(ano_min, ano_max))
]

if genero_sel:
    df_filtrado = df_filtrado[df_filtrado['genres'].str.contains('|'.join(genero_sel), na=False)]

st.divider()
if st.button("✨ Me Surpreenda!"):
    if not df_filtrado.empty:
        filme_aleatorio = df_filtrado.sample(1).iloc[0]
        st.success(f"Nossa sugestão principal: **{filme_aleatorio['title']}** ({int(filme_aleatorio['release_year'])})")
        st.info(f"Nota: {filme_aleatorio['vote_average']} | Duração: {filme_aleatorio['runtime']} min")
    else:
        st.warning("Nenhum filme encontrado com esses filtros para sortear!")

st.subheader("📋 Filmes Recomendados")
if not df_filtrado.empty:
    st.dataframe(df_filtrado[['title', 'release_year', 'vote_average', 'runtime', 'genres']].head(20))
else:
    st.write("Nenhum filme encontrado. Tente ajustar os filtros!")

st.divider()
st.subheader("📊 Análise do Catálogo Filtrado")

col1, col2, col3 = st.columns(3)

with col1:
    fig1 = px.histogram(df_filtrado, x="vote_average", title="Distribuição das Notas", nbins=20)
    st.plotly_chart(fig1, use_container_width=True)

with col2:
    contagem_anos = df_filtrado['release_year'].value_counts().reset_index().sort_values('release_year')
    fig2 = px.line(contagem_anos, x="release_year", y="count", title="Filmes lançados por Ano")
    st.plotly_chart(fig2, use_container_width=True)

with col3:
    fig3 = px.scatter(df_filtrado, x="popularity", y="vote_average", title="Popularidade vs Nota", opacity=0.5)
    st.plotly_chart(fig3, use_container_width=True)