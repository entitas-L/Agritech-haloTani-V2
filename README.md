# Agritech haloTani V2

A smart agricultural management and AI assistance system built with Laravel 11, Filament v3, and Livewire.

---

## 🤖 AI Service Integration

The AI assistance module in **Agritech V2** is built on a **Provider-Agnostic AI Integration** architecture designed for ultra-fast response times, high availability, and fault tolerance.

### AI Assistant Features:
- **Primary High-Speed Provider**: Powered by **Cerebras Cloud API** utilizing high-performance models (`llama3.3-70b` / `llama3.1-8b` / `gpt-oss-120b`) for instant inference.
- **Fallback Gateway**: Supported by **OpenRouter Gateway** (Nvidia Nemotron 3.5 Lightning, Google Gemini, Qwen) to ensure zero downtime when rate limits or API outages occur.
- **Agricultural Diagnostics**: Automated crop disease and pest diagnosis based on farmer complaint descriptions and field location context, delivering actionable treatment plans.

---

## 💡 Key Features: Agritech AI Consultation

The system provides an intelligent consultation module to help farmers analyze plant issues and receive immediate care recommendations.

### Highlights & Architecture:
- **Ultra-Fast Inference & Fallback System**: Prioritizes Cerebras Cloud API for rapid responses and seamlessly fails over to backup models/providers during network latency or API congestion.
- **Graceful Error Handling**: Implements dynamic cURL timeouts and exception catching to prevent HTTP 500 errors and maintain an uninterrupted user experience.
- **Data Persistence & State Binding**: Farmer complaints, location data, dynamic urgency levels (`rendah`, `sedang`, `tinggi`), and full AI recommendations are saved persistently in MySQL using UUID keys and `LONGTEXT` fields.
- **Dashboard Parsing & Visualization**: Integrated regex parsing engine in Filament v3 widgets to extract and visualize crop types and color-coded urgency badges (`danger`, `warning`, `info`).
- **Markdown Rendering**: AI responses are automatically rendered with clean Markdown syntax and line-break formatting (`whitespace-pre-line`) for optimal readability.

---

## 🛠️ Tech Stack

- **Framework & UI**: Laravel 11, Filament v3, Livewire
- **AI Infrastructure**: Cerebras Cloud API (`https://api.cerebras.ai/v1`), OpenRouter API
- **HTTP Client**: Laravel `Http` Facade (cURL Wrapper with dynamic timeout handling)
- **Database**: MySQL / MariaDB (UUID & `LONGTEXT` support)

---

## ⚙️ Environment Configuration (`.env`)

Add the following API keys and model configurations to your local `.env` file:

```env
# Cerebras Cloud API (Primary - Ultra Fast Inference)
CEREBRAS_API_KEY=csk-your-cerebras-api-key-here
CEREBRAS_MODEL=llama3.3-70b

# OpenRouter Gateway (Fallback Provider)
OPENROUTER_API_KEY=sk-or-v1-your-openrouter-key-here
OPENROUTER_MODEL=nvidia/nemotron-3.5-lightning:free
```

### Services Configuration (`config/services.php`)

Ensure your service configurations include the Cerebras provider credentials:

```php
'cerebras' => [
    'key'   => env('CEREBRAS_API_KEY'),
    'model' => env('CEREBRAS_MODEL', 'llama3.3-70b'),
],

'openrouter' => [
    'key'   => env('OPENROUTER_API_KEY'),
    'model' => env('OPENROUTER_MODEL', 'nvidia/nemotron-3.5-lightning:free'),
],
```

---

## 🗄️ Database & Collaboration Setup

1. **Database Migration / Import**:
   - Run standard migrations:
     ```bash
     php artisan migrate
     ```
   - Alternatively, import the synchronized SQL dump file (`database/db_paling_baru.sql`) via phpMyAdmin or your MySQL client across OS environments (Linux/Windows).
2. **Urgency Column Structure**: Ensure the `tingkat_urgensi` column in the `keluhans` table has no hardcoded default constraints to allow dynamic form urgency binding.

---

## 📌 Agritech-V2 Roadmap

- [x] Integration of Cerebras Cloud API for ultra-fast Llama 3.3 diagnostics.
- [x] Dynamic urgency binding & Filament v3 dashboard table parser.
- [ ] 2-Column User Profile & Account Management Redesign (Scheduled for upcoming V2 sprint).
